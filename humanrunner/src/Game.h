#pragma once
#include <vector>
#include "Player.h"
#include "GirdMap.hpp"
#include "Json.hpp"
class Game
{
private:
	std::vector<int32_t>movementSetSatori;
	std::vector<int32_t>movementSetKoishi;
	std::shared_ptr<Player> satori;
	std::shared_ptr<Player> koishi;
	GridMap<Gird01> map;
	int32_t round, roundLimit;
	int32_t timeLimit, memoryLimit;
	Vec2i startPositionSatori, startPositionKoishi;
	std::string AIPathSatori, AIPathKoishi;
	void printMap();
	bool timeUp();
	bool catchUp(int32_t movementSatori,int32_t movementKoishi);
	std::pair<int32_t,bool> getMovementForSatori();
	std::pair<int32_t, bool> getMovementForKoishi();
	bool roundFinish(int32_t movementSatori, int32_t movementKoishi);
	bool movementIsLegal(std::shared_ptr<Player> player, int32_t movement);
public:
	void runGame(); 
	void initGame(nlohmann::json parameter);
};

