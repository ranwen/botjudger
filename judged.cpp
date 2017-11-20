#include<iostream>
#if defined(_WIN32)
#include<windows.h>
#endif
#include<cstdlib>
#include<fstream>
using namespace std;
void system(string x)
{
	system(x.c_str());
}
int main()
{
	while(1)
	{
		ifstream infile; 
		infile.open("task.txt");
		string a,b,c,d;
    	while(infile>>a>>b>>c>>d)
    	{
			#if defined(__linux__)
			system("cp ./code/koishi/"+a+".exe ./runner/koishi.exe");
			system("cp ./code/satori/"+b+".exe ./runner/satori.exe");
			system("./runner/run.sh "+c+".txt "+a+" "+b+" "+d+".txt");
			#elif defined(_WIN32)
    		system("copy .\\code\\koishi\\"+a+".exe .\\runner\\koishi.exe");
    		system("copy .\\code\\satori\\"+b+".exe .\\runner\\satori.exe");
    		system(".\\runner\\run.bat "+c+".txt "+a+" "+b+" "+d+".txt");
			#endif
    	}
    	infile.close(); 
    	ofstream fileout("task.txt",ios::trunc);
    	fileout.close();
		cout<<"DONE"<<endl;
		#if defined(__linux__)
		system("sleep 2s");
		#elif defined(_WIN32)
		Sleep(2000);
		#endif
	}
}
