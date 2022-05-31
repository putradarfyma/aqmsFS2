import subprocess
import sys
import json
import time
import pathlib
import os
import db_connect

try:
    mydb = db_connect.connecting()
    mycursor = mydb.cursor()
    print("[V] Misol CONNECTED")
except Exception as e: 
    print("[X]  Misol  Sensor ID: " + str(sys.argv[1]) + " " + e)
    
def update_sensor_value(sensor_reader_id,value):
    try:
        try:
            mycursor.execute("SELECT id FROM sensor_values WHERE sensor_reader_id = '"+ sensor_reader_id +"' AND pin = '0'")
            sensor_value_id = mycursor.fetchone()[0]
            mycursor.execute("UPDATE sensor_values SET value = '" + value + "' WHERE id = '" + str(sensor_value_id) + "'")
            mydb.commit()
        except Exception as e:
            mycursor.execute("INSERT INTO sensor_values (sensor_reader_id,pin,value) VALUES ('" + sensor_reader_id + "','0','" + value + "')")
            mydb.commit()
            print(e)
    except Exception as e2:
        print(e2)
        return None
    

home = subprocess.check_output(['pwd'], cwd=pathlib.Path.home(),shell=True)
home = home.decode("utf-8").replace('\n', '')
json_path = home+"/aqmsFS2/misol.json"
print(json_path)
while True:
    try:
        if os.path.exists(json_path):
            os.remove(json_path)
        sub = subprocess.call("rtl_433 -F json -E quit >> "+json_path, shell=True)
        # time.sleep(10)
        if (int(os.stat(json_path).st_size) > 0):
            f = open(json_path)
            misol_json = json.load(f)
            if(misol_json['id'] == 103 or misol_json['id'] == 80):
                pressure = "0";
                sr = "0";
                ws = str(misol_json['wind_avg_km_h']);
                wd = str(misol_json['wind_dir_deg'])
                humidity = str(misol_json['humidity'])
                temperature = str(misol_json['temperature_C'])
                rain_intensity = str(misol_json['rain_mm'])
                WS = ";0;" + pressure + ";0;0;" + temperature + ";" + ws + ";0;" + wd + ";" + humidity + ";0;0;" + sr + ";0.0;0;" + rain_intensity + ";0;0"
                print("WS => " + WS)
                update_sensor_value(str(sys.argv[1]),WS)
                if os.path.exists(json_path):
                    os.remove(json_path)

    except Exception as e2:
        print(e2)

    time.sleep(1)