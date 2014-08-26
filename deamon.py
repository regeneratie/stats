
#!/usr/bin/python

import os
import time


OPDRACHT = "pietje"

while OPDRACHT > 0:
        deamon = 'quakestat  -utf8 -of deathmatch.xml -P -xml -q2s 212.116.37.42:27920'
        #quakestat -of fi_stats -P -xml -q2s 212.116.37.42:27920
        os.system(deamon)
        print "slapen 3 sec . . . . . . ."
        time.sleep(3.0)
	server = 'php5 index.php'
	os.system(server)
	print "slapen 2 sec"
	time.sleep(3.0)

