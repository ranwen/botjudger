#pragma once
#include <iostream>
#include <vector>
#include "Vector2.h"
class Player
{
private:
	Vec2i position;
public:
	virtual void setPosition(Vec2i position_)
	{
		position = position_;
	}
	virtual Vec2i getPosition()
	{
		return position;
	}
};