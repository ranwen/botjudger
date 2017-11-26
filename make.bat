g++ judged.cpp -o judged.exe
g++ humanjudged.cpp -o humanjudged.exe
cd runner
cd src
g++ main.cpp Game.cpp -o judge.exe --std=c++11
move judge.exe ..\judge.exe
cd ..
cd ..
cd humanrunner
cd src
g++ main.cpp Game.cpp -o judge.exe --std=c++11
move judge.exe ..\judge.exe