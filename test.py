from datetime import datetime

# Données des périodes de travail
timestamps = [
    ("31/10/2024 13:58", "31/10/2024 20:48"),
    ("26/10/2024 15:49", "26/10/2024 21:29"),
    ("25/10/2024 16:25", "25/10/2024 21:17"),
    ("18/10/2024 16:03", "18/10/2024 20:54"),
    ("12/10/2024 11:03", "12/10/2024 20:35"),
    ("11/10/2024 16:57", "11/10/2024 22:31"),
    ("05/10/2024 15:47", "05/10/2024 20:33")
]

hourly_rate = 12.9336
rsz_rate = 0.0271

# Fonction pour calculer la durée en heures entre deux timestamps
def hours_between(start, end):
    return (datetime.strptime(end, "%d/%m/%Y %H:%M") - datetime.strptime(start, "%d/%m/%Y %H:%M")).total_seconds() / 3600

# Calcul du total des heures
total_hours = sum(hours_between(start, end) for start, end in timestamps)

# Calcul du salaire brut, cotisation RSZ et salaire net avec arrondi
gross_income = round(total_hours * hourly_rate, 2)
net_income = round(gross_income * (1 - rsz_rate), 2)

# Afficher les résultats avec deux décimales
print("Total heures:", "{:.2f}".format(total_hours), "h")
print("Salaire brut:", "{:.2f}".format(gross_income), "€")
print("Salaire net après RSZ:", "{:.2f}".format(net_income), "€")

# Calculs pour les dépenses
print("{:.2f}".format(net_income), "- 24.99€ basic-fit")
net_income_basic = net_income - 24.99
print("Cela fait:", "{:.2f}".format(net_income_basic), "€")

print("{:.2f}".format(net_income_basic), "- 19.99€ netflix")
net_income_netflix = net_income_basic - 19.99
print("Cela fait:", "{:.2f}".format(net_income_netflix), "€")

print("{:.2f}".format(net_income_netflix), "- 9.99€ apple")
net_income_apple = net_income_netflix - 9.99
print("Cela fait:", "{:.2f}".format(net_income_apple), "€")


print("{:.2f}".format(net_income_apple), "- 333.25€ klarna et cadeau et épargne")
net_income_totale = net_income_apple - 333.25 - 11.99 - 50 + 2.19 - 29 + 20
print("Cela fait:", "{:.2f}".format(net_income_totale), "€ ce qui reste au total")
