import mysql.connector
import os
import time
import subprocess
from subprocess import Popen,PIPE

#coding=GBK
dic1 = {'1080':4000000,'720':1800000,'480':600000}
dic2 = {'1080':'high','720':'mid','480':''}
root = 'D:\\Github\\VideoEncoder\\basic\\web\\files\\'


def findSuitableResolution(resolution):
	if (int(resolution[0])>=1920)|(int(resolution[1])>=1080):
		print 'reslution is 1080p \n'
		return '1080'
	if (int(resolution[0])>=1280)|(int(resolution[1])>=720):
		print 'reslution is 720p \n'
		return '720'
	print 'reslution is 480p \n'
	return '480'



def setTask(path,md5,maxR,resolution):
	scale = float(resolution[1])/float(resolution[0])
	if int(maxR)==1080:
		processEncoder(path,root+'high\\'+md5+'.mp4',dic1['1080'],[1920,1920*scale])
	if int(maxR)>=720:
		processEncoder(path,root+'mid\\'+md5+'.mp4',dic1['720'],[1280,1280*scale])
	processEncoder(path,root+'low\\'+md5+'.mp4',dic1['480'],[640,640*scale])

def processEncoder(inputPath,outputPath,bitrate,resolution):
	f = open('./test.bat','w')
	command = '"D:\\Program Files\\ffmpeg\\bin\\ffmpeg.exe" -y -i "%s" -vcodec h264 -b %s -s %dx%d "%s"' % (inputPath,bitrate,resolution[0],resolution[1],outputPath)
	f.write(command)
	f.close
	print command+'\n'
	p2 = Popen(command,shell=True,stdout=PIPE)
	p2.wait()

while 1:
	conn = mysql.connector.connect(user='root', password='123456', database='yii2basic', use_unicode=True)
	cursor = conn.cursor()
	cursor.execute('select filename,path,resolution,md5,1080p,id from video where 1080p=-1 limit 10')
	values = cursor.fetchall()
	if len(values)==0:
		print "Task Finished, Sleeping..."
		time.sleep(60)

	for item in values:
		print str(item)+'\n'
		resolution = item[2].split('x')
		maxR = findSuitableResolution(resolution)
		setTask(item[1],item[3],maxR,resolution)
		print maxR
		if int(maxR)>=1080:
			p1080 = 1
		else:
			p1080 = 0
		if int(maxR)>=720:
			p720 = 1
		else:
			p720 = 0
		p480 = 1
		sql = 'update video item set item.1080p = %d,item.720p = %d,item.480p = %d where item.id = %d' % (p1080,p720,p480,item[5])
		print sql
		cursor.execute(sql)
	cursor.close()
	conn.commit()
	conn.close()