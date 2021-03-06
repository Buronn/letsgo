import csv
def fechas(age1,age2,lista):
    output = []
    for i in lista:
        age = i.split(" ")
        b = age[1]
        age = int(age[0])
        if (age >= int(age1) and age <= int(age2)):
            output.append(b)
    return output
    

lista = []
with open('composers.csv', encoding='utf8') as archivo:
    datos = csv.reader(archivo)
    for linea in datos:
        #filtra los que no son numeros
        if (linea[1].isnumeric()):
            if (int(linea[1]) < 1000):
                lista.append("0"+linea[1]+" "+linea[0])
            else:
                lista.append(linea[1]+" "+linea[0])
lista.sort()

#para extraer los años
for x in range(len(lista)):
    aux = lista[x][:4] #toma los primeros 4 caracteres del string

print("Ingrese una opción: \n 1. Búsqueda por fechas \n 2. Búsqueda por periodos")
option = input() 

if (option == '1'):
    print("Ingrese la primera fecha:")
    age1 = input()
    print("Ingrese la segunda fecha:")
    age2 = input()
    if (int(age1) > int(age2)):
        aux = age1
        age1 = age2
        age2 = aux
    print(age1,age2)
    resultado = fechas(age1,age2,lista)

if (option == '2'):
    print("Escoja uno de estos periodos: \n 1. Edad Media \n 2. Renacentismo \n 3. Clásica \n 4. Clasicismo \n 5. Romanticismo \n 6. Impresionismo \n 7. Moderna")
    option = input()
    if (option == '1'):
        age1=476
        age2=1450
    if (option == '2'):
        age1=1451
        age2=1600
    if (option == '3'):
        age1=1601
        age2=1760
    if (option == '4'):
        age1=1761
        age2=1800
    if (option == '5'):
        age1=1801
        age2=1860
    if (option == '6'):
        age1=1861
        age2=1910
    if (option == '7'):
        age1=1911
        age2=2021
    resultado = fechas(age1,age2,lista)


print(resultado)
wait = input()