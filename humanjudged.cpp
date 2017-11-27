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
		infile.open("humantask.txt");
		string a,b,c,d,e;
		bool have_task_flag=false; 
    	while(infile>>a>>b>>c>>d>>e)
    	{
    		have_task_flag=true; 
			#if defined(__linux__)
			system("cp ./code/koishi/"+a+".exe ./humanrunner/koishi.exe");
			system("cp ./code/satori/"+b+".exe ./humanrunner/satori.exe");
			system("./runner/run.sh "+c+".txt "+a+" "+b+" "+d+".txt");
			#elif defined(_WIN32)
    		system("copy .\\code\\koishi\\"+a+".exe .\\humanrunner\\koishi.exe");
    		system("copy .\\code\\satori\\"+b+".exe .\\humanrunner\\satori.exe");
    		system("echo "+e+" >passwd");
    		system(".\\humanrunner\\run.bat "+c+".txt "+a+" "+b+" "+d+".txt");
			#endif
    	}
    	infile.close(); 
    	ofstream fileout("humantask.txt",ios::trunc);
    	fileout.close();
    	if(have_task_flag)
		cout<<"DONE"<<endl;
		#if defined(__linux__)
		system("sleep 15s");
		#elif defined(_WIN32)
		Sleep(5000);
		#endif
	}
}
