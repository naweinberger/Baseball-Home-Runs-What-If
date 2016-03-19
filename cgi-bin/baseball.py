#!/usr/bin/env python
import cgi
import cgitb
import os
cgitb.enable()

print "Content-Type: text/plain;charset=utf-8"

GET={}
args=os.getenv("QUERY_STRING").split('&')

for arg in args: 
    t=arg.split('=')
    if len(t)>1: k,v=arg.split('='); GET[k]=v

degrees = float(GET.get('elevation'))
v = float(GET.get('velocity'))
g = float(GET.get('gravity'))
P = float(GET.get('pressure'))
T = float(GET.get('temperature'))

m = .145
A = 3.14*0.0366*2**2/4
C = .0060
####rho = 1.0
##P = 101300 # Pascals
R = 287.058
##T = 308 # Kelvin
rho = P/(R*T)
D = rho*C*A/2
#g = 9.81

delta_t = .01
x = [0]
y = [0]
#v = 46.76
#degrees = 23.7
theta = degrees/180.0*3.14
vx = v*math.cos(theta)
vy = v*math.sin(theta)
t = [0]

i = 0
while min(y) > -0.001 and i < 1000000:
    ax = -(D/m)*v*vx
    ay = -g-(D/m)*v*vy
    vx = vx+ax*delta_t
    vy = vy+ay*delta_t

    x.append(x[i] + vx*delta_t + 0.5*ax*delta_t**2)
    y.append(y[i]+vy*delta_t+0.5*ay*delta_t**2)
    t.append(t[i]+delta_t)

    i += 1

# to feet
x = map(lambda i: 3.28*i, x)
y = map(lambda i: 3.28*i, y)

print x[-1]

##plt.xlim(0, 500)
##plt.ylim(-1, 100)
##plt.plot(x, y, 'b-')
##plt.show()

