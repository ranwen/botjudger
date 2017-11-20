g++ judged.cpp -o judged.exe
cd runner
cd src
g++ main.cpp Game.cpp -o judge.exe --std=c++11
move judge.exe ..\judge.exe
