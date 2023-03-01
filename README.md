# CollectiveAccessINBO

File coding
- xml-file: INBO_profiel.xml 0.26.03 | 0 = production | 26 = test number of profile, to load into system | 03 = version of the new code in prep of load

Currently loaded:
- xml-file:	INBO_profiel_025.xml
- INBO test	18.203.229.50/ca - user name: administrator - pass:	2c32e9fc

More information
- handleiding	https://manual.collectiveaccess.org/providence/user/dataModelling/profiles/XMLSchema.html
- demo-website	https://demo.collectiveaccess.org/

Load a new profile:
- reset INBO test	18.203.229.50/ca/install - user: emily.veltjen@inbo.be - choose profiel -	check: overwrite
- add a new profile	VPN - WINSCP - 172.28.2.47 poort 22 - /var/www/html/ca/install/profiles/xml
