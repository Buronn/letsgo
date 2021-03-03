import random


def comparar(lista, cadena, tamaño):
    fama = 0
    toque = 0
    for i in range(0, tamaño):
        if(int(cadena[i]) == lista[i]):
            fama = fama+1
            print("una fama")
        elif int(cadena[i]) in lista:
            toque = toque+1
            print("un toque")
        if fama = tamaño:
            print("OMEDETO")
        else:
            print("obtuviste "+str(toque)+" toques y "+str(fama)+" fama.")


print("seleccione dificultad:")
print("1.Facil")
print("2.Normal")
print("3.Dificil")

valor = input()
if valor == "1":
    tamaño = 3
if valor == "2":
    tamaño = 5
if valor == "3":
    tamaño = 7
lista = []
for i in range(0, tamaño):
    lista.append(random.randrange(10))
for i in range(0, 10):
    print("ingresa una secuencia de " + str(tamaño) + " numeros")
    cadena = input()
    comparar(lista, cadena, tamaño)
print(lista)
