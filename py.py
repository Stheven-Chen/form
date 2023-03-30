import mysql.connector

conn = mysql.connector.connect(
    host = "localhost", 
    user = "root", 
    password = "", 
    database = "mobil"
    )

curr = conn.cursor()

sql = "SELECT * FROM merek_mobil "

curr.execute(sql)

result = curr.fetchall()

merek = []

for i in result :
    merek = i 
    print(merek)
    print(type(merek), "len dari merek adalah", len(merek))