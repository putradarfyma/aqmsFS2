from mysql.connector.constants import ClientFlag
import mysql.connector

def connecting():
    try:
        return mysql.connector.connect(host="localhost",user="root",passwd="R2h2s12*",database="aqms_fs2")
    except Exception as e: 
        subprocess.Popen("echo admin | kill -S $(ps aux | grep '[p]hp' | awk '{print $2}')", shell=True)
        subprocess.Popen("echo admin | kill -S $(ps aux | grep '[p]ython' | awk '{print $2}')", shell=True)
        return false