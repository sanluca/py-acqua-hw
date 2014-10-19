import ephem
o=ephem.Observer()
o.lat='44.0329201'
o.long='8.1023705'
s=ephem.Sun()
s.compute()

sunrise=ephem.localtime(o.previous_rising(ephem.Sun())) #Sunrise
noon   =ephem.localtime(o.next_transit   (ephem.Sun(), start=sunrise)) #Solar noon
sunset =ephem.localtime(o.next_setting   (ephem.Sun())) #Sunset
print sunrise, noon, sunset

