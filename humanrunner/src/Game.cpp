#pragma once
#include <sstream>
#include <fstream>
#include "Constant.h"
#include "File.hpp"
#include "Game.h"
using json = nlohmann::json;
using namespace std;
bool Game::timeUp()
{
	return (round >= roundLimit&&roundLimit >= 0);
}
std::pair<int32_t, bool> Game::getMovementForSatori()
{
	ofstream output("satori.in");
	output << map.size().x << " " << map.size().y<<" "<<startPositionSatori.x<<" "<< startPositionSatori.y<<" "<<startPositionKoishi.x<<" "<< startPositionKoishi.y<<" "<< roundLimit << endl;
	for (int32_t i = 0; i < map.size().x; ++i)
	{
		for (int32_t j = 0; j < map.size().y; ++j)
			output << (int)map.getGird(i, j)<<" ";
		output << endl;
	}
	output << round+1 << endl;
	for (int32_t i = 0; i < round; ++i)
		output << movementSetSatori[i] << endl;
	bool timeLimitExceeded=FileManager::openEXE(AIPathSatori + "\\satori.exe",timeLimit);
	if (timeLimitExceeded)return make_pair(-1, false);
	ifstream input("satori.out");
	int32_t newMovement=5;
	input >> newMovement;
	movementSetSatori.push_back(newMovement);
	return make_pair(newMovement, movementIsLegal(satori, newMovement));
}
std::pair<int32_t, bool> Game::getMovementForKoishi()
{
	ofstream output("koishi.in");
	output << map.size().x << " " << map.size().y << " " << startPositionSatori.x << " " << startPositionSatori.y << " " << startPositionKoishi.x << " " << startPositionKoishi.y << " " << roundLimit << endl;
	for (int32_t i = 0; i < map.size().x; ++i)
	{
		for (int32_t j = 0; j < map.size().y; ++j)
			output << (int)map.getGird(i, j)<<" ";
		output << endl;
	}
	output << round+1 << endl;
	for (int32_t i = 0; i < round; ++i)
		output << movementSetSatori[i] << " "<< movementSetKoishi[i]<<endl;
	bool timeLimitExceeded = FileManager::openEXE(AIPathKoishi + "\\koishi.exe", timeLimit);
	if(timeLimitExceeded)return make_pair(-1, false);
	ifstream input("koishi.out");
	int32_t newMovement=5;
	input >> newMovement;
	movementSetKoishi.push_back(newMovement);
	return make_pair(newMovement, movementIsLegal(koishi, newMovement));
}
bool Game::catchUp(int32_t movementSatori, int32_t movementKoishi)
{
	Vec2i newPositionSatori = satori->getPosition() + cns::delta[movementSatori];
	Vec2i newPositionKoishi = koishi->getPosition() + cns::delta[movementKoishi];
	if (newPositionSatori == koishi->getPosition() && satori->getPosition() == newPositionKoishi)
		return true;
	if (newPositionKoishi == newPositionSatori)
		return true;
	return false;
}
bool Game::roundFinish(int32_t movementSatori, int32_t movementKoishi)
{
	round++;
	bool catchup = catchUp(movementSatori, movementKoishi);
	satori->setPosition(satori->getPosition() + cns::delta[movementSatori]);
	koishi->setPosition(koishi->getPosition() + cns::delta[movementKoishi]);
	if (catchup)return true;
	if (timeUp())
	{
		round++;
		return true;
	}
	return false;
}
bool Game::movementIsLegal(std::shared_ptr<Player> player, int32_t movement)
{
	if (movement > 4)return false;
	Vec2i newPosition = player->getPosition() + cns::delta[movement];
	if (newPosition.x >= map.size().x || newPosition.x < 0)return false;
	if (newPosition.y >= map.size().y || newPosition.y < 0)return false;
	if (map[newPosition.x][newPosition.y] == Gird01::WALL)return false;
	return true;
}
void Game::printMap()
{
	for (int32_t i = 0; i < map.size().x; ++i)
	{
		for (int32_t j = 0; j < map.size().y; ++j)
		{
			if (Vec2i(i, j) == satori->getPosition())
				cout << "S";
			else if (Vec2i(i, j) == koishi->getPosition())
				cout << "K";
			else cout << ((int)map.getGird(i, j)==0?".":"#");
		}
		cout << endl;
	}
}
void Game::runGame()
{
	bool satoribadmoveflag = false;
	bool koishibadmoveflag = false;
	cout << "game start" << endl;
	if (!(roundLimit == 0 || startPositionSatori == startPositionKoishi))
	{
		std::pair<int32_t, bool> movementSatori,movementKoishi;
		do
		{
			printMap();
			cout << endl << "round " << round+1<< ":" << endl;
			movementSatori = getMovementForSatori();
			if(!movementSatori.second)satoribadmoveflag = true;
			movementKoishi = getMovementForKoishi();
			if (!movementKoishi.second)koishibadmoveflag = true;
			if (satoribadmoveflag || koishibadmoveflag)break;
		} while (!roundFinish(movementSatori.first, movementKoishi.first));
		printMap();
	}
	cout << "game over" << endl;
	if (satoribadmoveflag&&koishibadmoveflag)cout << "Both Bad move!" << endl;
	else if (satoribadmoveflag)cout << "Satori Bad move!" << endl;
	else if (koishibadmoveflag)cout << "Koishi Bad move!" << endl;
	else cout << "result:koishi lived " << round << " seconds." << endl;
	FileManager::deleteFile("satori.in");
	FileManager::deleteFile("satori.out");
	FileManager::deleteFile("koishi.in");
	FileManager::deleteFile("koishi.out");
	FileManager::deleteFile("koishi.tmp");
	FileManager::deleteFile("satori.tmp");
	FileManager::deleteFile("koishimap.txt");
	FileManager::deleteFile("satorimap.txt");
}
void Game::initGame(json parameter)
{
	AIPathSatori = parameter["AIPathSatori"].get<string>();
	AIPathKoishi = parameter["AIPathKoishi"].get<string>();
	timeLimit=(int32_t)parameter["timeLimit"];
	memoryLimit = (int32_t)parameter["memoryLimit"];
	ifstream input(parameter["mapFile"].get<string>());
	Vec2u mapSize;
	input >> mapSize.x >> mapSize.y >> startPositionSatori.x >> startPositionSatori.y >> startPositionKoishi.x >> startPositionKoishi.y >> roundLimit;
	cout << "Round limit:" << roundLimit << endl;
	cout << "Map:" << parameter["Map"].get<string>() << endl;
	cout << "Satori:" << parameter["Satori"].get<string>() <<" Koishi:"<<parameter["Koishi"].get<string>()<< endl;
	map.resize(mapSize);
	round = 0;
	satori = make_shared<Player>();
	koishi = make_shared<Player>();
	satori->setPosition(startPositionSatori);
	koishi->setPosition(startPositionKoishi);
	for (int32_t i = 0; i <map.size().x; ++i)
	{
		for (int32_t j = 0; j < map.size().y; ++j)
		{
			int32_t temp;
			input >> temp;
			map.setGird(i, j, (Gird01)temp);
		}
	}
}
