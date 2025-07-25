from efficient_apriori import apriori
import sys
import json

def main():
    # Leer datos JSON desde la entrada estándar (stdin)
    input_data = json.load(sys.stdin)
    transacciones = input_data['transacciones']

    # Ejecutar Apriori con soporte y confianza mínimos
    itemsets, reglas = apriori(
        transacciones,
        min_support=0.5,
        min_confidence=0.6
    )

    # Preparar las reglas para salida JSON, incluyendo lift
    reglas_filtradas = [
        {
            'lhs': list(rule.lhs),
            'rhs': list(rule.rhs),
            'confidence': rule.confidence,
            'support': rule.support,
            'lift': rule.lift  # Aquí se agrega el lift
        }
        for rule in reglas
        if len(rule.rhs) == 1 and len(rule.lhs) >= 1
    ]

    # Imprimir el JSON formateado (respuesta para PHP o el frontend)
    print(json.dumps(reglas_filtradas, indent=2))

if __name__ == "__main__":
    main()
