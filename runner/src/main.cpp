#include <iostream>
#include <string>
#include "Game.h"
#include "Json.hpp"
using json = nlohmann::json;
using namespace std;
std::shared_ptr<Game> game;
string Argv[5];
void initGame()
{
	json parameter;
	//parameter["AIPathSatori"] = "source\\test";
	//parameter["AIPathKoishi"] = "source\\test";
	parameter["AIPathSatori"] = ".\\";
	parameter["AIPathKoishi"] = ".\\";
	parameter["mapFile"]="..\\map\\"+Argv[2];
	parameter["timeLimit"] = 1500;
	parameter["memoryLimit"] = 512000;
	parameter["Satori"] = Argv[1];
	parameter["Koishi"] = Argv[0];
	parameter["Map"] = Argv[2];
	game = make_shared<Game>();
	cout << "loading parameters" << endl;
	game->initGame(parameter);
	cout << "successful" << endl;
}
void startGame()
{
	game->runGame();
}
int main(int argc, char* argv[])
{
	Argv[0]="";
	for(int i=0;argv[1][i];i++)	Argv[0]=Argv[0]+argv[1][i];
	Argv[1]="";
	for(int i=0;argv[2][i];i++)	Argv[1]=Argv[1]+argv[2][i];
	Argv[2]="";
	for(int i=0;argv[3][i];i++)	Argv[2]=Argv[2]+argv[3][i];
//	cout<<Argv[2]<<endl;
	initGame();
	startGame();
	//cout << "press Q to exit..." << endl;
	//while (getchar() != 'q');
}
