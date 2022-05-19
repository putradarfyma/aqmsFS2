from __future__ import print_function
import sys
import serial
import time
import db_connect

is_ANALYZER_connect = False

try:
    mydb = db_connect.connecting()
    mycursor = mydb.cursor()
    
    mycursor.execute("SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '"+ sys.argv[1] +"'")
    sensor_reader = mycursor.fetchone()
except Exception as e: 
    print("[X]  ANALYZER Module ID: " + str(sys.argv[1]) + " " + e)
    
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
    except Exception as e2:
        return None
        
def connect_analyzer():
    global is_ANALYZER_connect
    try:
        mycursor.execute("SELECT sensor_code,baud_rate FROM sensor_readers WHERE id = '"+ sys.argv[1] +"'")
        sensor_reader = mycursor.fetchone()
        print(sensor_reader)
        
        COM_ANALYZER = serial.Serial(sensor_reader[0], sensor_reader[1])
        ANALYZER = str(COM_ANALYZER.read_until("#"))
        print(ANALYZER)
        if(ANALYZER.count("$MCU_ANZ") > 0):
            is_ANALYZER_connect = True
            print("[V] ANALYZER Module " + sensor_reader[0] + " CONNECTED")
            return COM_ANALYZER
        else:
            is_ANALYZER_connect = False
            return None
            
    except Exception as e: 
        return None
    
connect_analyzer()

try:
    while True :
        try:
            if(not is_ANALYZER_connect):
                COM_ANALYZER = connect_analyzer()
                
            ANALYZER = str(COM_ANALYZER.read_until("#"))
            print(ANALYZER)
            if(ANALYZER.count("$MCU_ANZ") <= 0):
                ANALYZER = "FS2_ANALYZER;000.000;0.0;000.000;0.0;0;0.00;0.00;0.00;0.00;\\r\\n'"
                
            update_sensor_value(str(sys.argv[1]),ANALYZER.replace("'","''"))
            
        except Exception as e2:
            print(e2)
            is_ANALYZER_connect = False
            print("Reconnect ANALYZER Module ID: " + str(sys.argv[1]));
            update_sensor_value(str(sys.argv[1]),0)
        
        time.sleep(1)
        
except Exception as e: 
    print(e)