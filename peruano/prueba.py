# FUNDAMENTOS DE PROGRAMACIÓN PARA INGENIERÍA
# SECCIÓN DEL CURSO: 2-L-1
# PROFESOR DE TEORÍA: FELIPE MORENO
# PROFESOR DE LABORATORIO: JUAN PADILLA
#
# AUTOR
# NOMBRE:
# RUT:
# CARRERA:
# DESCRIPCIÓN DEL PROGRAMA ...<CONTINÚE CON EL PROGRAMA A PARTIR DE AQUÍ>
from datetime import datetime
import matplotlib.pyplot as plt
import numpy as np


def calcular_tiempo_transcurrido(inicio, termino):
    return (termino - inicio).total_seconds() * 1000000


def funcion_recursiva(a, b, c, avanzado, dias):

    avanzado = avanzado + a
    dias = dias + 3
    if (avanzado >= c):
        """ print(dias) """
        return
    avanzado = avanzado - b
    dias = dias+1
    if(avanzado < 0):
        """ print(-1) """
        return
    funcion_recursiva(a, b, c, avanzado, dias)


def funcion_iterativa(a, b, c):
    avanzado = 0
    dias = 0
    while(avanzado < c):
        avanzado = avanzado+a
        dias = dias+3
        if(avanzado >= c):

            return dias

        avanzado = avanzado-b
        dias = dias+1
        if(avanzado <= 0):

            return -1


tiempo_recursivo = []
tiempo_iterativo = []
lista_final = []
lista_recursiva = []
with open('entrada.txt', encoding='utf8') as archivo:
    datos = archivo.read()
    pos = 0
    splited = datos.split("\n")
    for linea in splited:
        splited = linea.split(" ")
        a = splited[0]
        b = splited[1]
        c = splited[2]
        i1 = datetime.now()
        funcion_recursiva(int(a), int(b), int(c), 0, 0)
        t1 = datetime.now()
        tiempo1 = calcular_tiempo_transcurrido(i1, t1)

        i2 = datetime.now()
        funcion_iterativa(int(a), int(b), int(c))
        t2 = datetime.now()
        tiempo2 = calcular_tiempo_transcurrido(i2, t2)

        lista_final.append([int(a), int(b), int(c), funcion_iterativa(
            int(a), int(b), int(c)), tiempo1, tiempo2])
        tiempo_recursivo.append(tiempo1)
        tiempo_iterativo.append(tiempo2)

""" print(lista_final) """
myFile = open("salida.txt", "w")
for i in lista_final:
    string = ""
    for j in i:
        string = string + str(j) + " "
    myFile.write(string+"\n")
myFile.close()

for i in range(len(tiempo_recursivo)):
    for j in range(len(tiempo_recursivo)):
        if(tiempo_recursivo[i] < tiempo_recursivo[j]):
            tiempo_recursivo[i], tiempo_recursivo[j] = tiempo_recursivo[j], tiempo_recursivo[i]
""" print(tiempo_recursivo) """
for i in range(len(tiempo_iterativo)):
    for j in range(len(tiempo_iterativo)):
        if(tiempo_iterativo[i] < tiempo_iterativo[j]):
            tiempo_iterativo[i], tiempo_iterativo[j] = tiempo_iterativo[j], tiempo_iterativo[i]
""" print(tiempo_iterativo) """

plt.title("Tiempo de funciones")
plt.xlabel("entrada")
plt.ylabel("tiempo (microsegundos)")
plt.plot(tiempo_iterativo, label="Funcion iterativa", color="g", linestyle=':')
plt.plot(tiempo_recursivo, label="Funcion recursiva",
         color="r", linestyle='--')
plt.xticks(np.arange(1, len(tiempo_recursivo)))
maximo = 0
if (tiempo_recursivo[len(tiempo_recursivo)-1] > tiempo_iterativo[len(tiempo_iterativo)-1]):
    maximo = tiempo_recursivo[len(tiempo_recursivo)-1]
else:
    maximo = tiempo_iterativo[len(tiempo_iterativo)-1]
plt.yticks(np.arange(0, maximo, 100))
plt.legend()
plt.show()
"""xd"""
