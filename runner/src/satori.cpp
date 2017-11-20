#include<iostream>
#include<cstdio>
#include<cstring>
#include<vector>
#include<time.h>
#include<cstdlib>
using namespace std;
bool map[33][33];
int n,m,ssx,ssy,skx,sky,tl,nowt;
const int dx[5]={-1,1,0,0,0};
const int dy[5]={0,0,-1,1,0};
int main()
{
	srand(time(0)); 
	freopen("satori.in","r",stdin);
	freopen("satori.out","w",stdout);
	cin>>n>>m>>ssx>>ssy>>skx>>sky>>tl;
	for(int i=0;i<n;++i)
		for(int j=0;j<m;++j)
			cin>>map[i][j];
	cin>>nowt;
	int x=ssx,y=ssy;
	for(int i=1;i<nowt;++i)
	{
		int temp;
		cin>>temp;
		x+=dx[temp];
		y+=dy[temp]; 
	}
	vector<int>movement;
	for(int i=0;i<4;++i)
	{
		int nextx=x+dx[i];
		int nexty=y+dy[i];
		if(nextx<0||nextx>=n||nexty<0||nexty>=m)continue;
		if(map[nextx][nexty])continue; 
		movement.push_back(i);
	}
	cout<<movement[rand()%movement.size()]<<endl;
}
