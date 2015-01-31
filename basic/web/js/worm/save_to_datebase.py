import mysql.connector
import json

conn = mysql.connector.connect(user='root', password='123456', database='yii2basic', use_unicode=True)
cursor = conn.cursor()
f = file(r'.\category.json')
categorys = json.load(f)
print categorys
i = 0
for category in categorys:
	i = i+1
	cursor.execute("insert into category(name) values('%s')" % (category[u'title']))
	for item in category[u'subTitle']:
		cursor.execute("insert into sub_category(name,father_id) values('%s',%d)" % (item,i))
f.close()
cursor.close()
conn.commit()
conn.close()

	