
#!/usr/bin/python

import os
import time


OPDRACHT = "pietje"

while OPDRACHT > 0:
        TheCommand = 'quakestat  -utf8 -of deathmatch.xml -P -xml -q2s 212.116.37.42:27910'
        #quakestat -of fi_stats -P -xml -q2s 212.116.37.42:27920
        os.system(TheCommand)
        print "slapen 5 sec . . . . . . ."
        time.sleep(5.0)

