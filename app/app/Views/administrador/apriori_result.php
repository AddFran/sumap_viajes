<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reglas de Asociación - Apriori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://unpkg.com/cytoscape@3.21.1/dist/cytoscape.min.js"></script>
    <style>
        :root {
            --primary-dark: #002244;
            --primary-base: #003366;
            --primary-light: #1c87ff;
            --text-light: #f8f9fa;
            --text-muted: #adb5bd;
            --bg-dark: #0a192f;
            --card-bg: rgba(255, 255, 255, 0.05);
            --border-radius: 12px;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, var(--bg-dark), #001a33);
            color: var(--text-light);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .admin-header {
            background: rgba(10, 25, 47, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-img {
            height: 40px;
            margin-right: 15px;
        }

        .admin-content {
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .admin-title {
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }

        .admin-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--primary-light);
            position: absolute;
            bottom: 0;
            left: 0;
            border-radius: 3px;
        }

        /* Panel de métricas */
        .metrics-panel .card {
            border-radius: var(--border-radius);
            border: none;
            transition: transform 0.3s ease;
            height: 100%;
        }

        .metrics-panel .card:hover {
            transform: translateY(-5px);
        }

        .metrics-panel .card-body {
            padding: 1.5rem;
        }

        .metrics-panel .card-title {
            font-size: 1rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .metrics-panel .card-text {
            font-size: 1.8rem;
            font-weight: 600;
        }

        /* Filtros */
        .filter-panel {
            background: rgba(255, 255, 255, 0.1);
            border-radius: var(--border-radius);
            padding: 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .filter-title {
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: var(--primary-light);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-group {
            margin-bottom: 15px;
        }

        .filter-label {
            display: block;
            margin-bottom: 5px;
            color: var(--text-muted);
        }

        .filter-value {
            font-weight: 500;
            color: var(--text-light);
        }

        /* Gráfico simplificado */
        #cy {
            width: 100%;
            height: 600px;
            background: white;
            border-radius: var(--border-radius);
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Explicación del gráfico */
        .graph-explanation {
            background: rgba(255, 255, 255, 0.1);
            border-radius: var(--border-radius);
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid var(--primary-light);
        }

        .graph-explanation ul {
            padding-left: 20px;
            margin-bottom: 0;
        }

        .graph-explanation li {
            margin-bottom: 8px;
        }

        /* Leyenda simplificada */
        .legend {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px 0;
            padding: 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: var(--border-radius);
            justify-content: center;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .node-legend {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #3498db;
        }

        .relation-legend {
            width: 30px;
            height: 3px;
            background: #2ecc71;
        }

        .highlight-legend {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #e74c3c;
        }

        /* Tabla */
        .rules-table {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .rules-table th {
            background-color: var(--primary-base);
            color: white;
            font-weight: 500;
            text-align: center;
        }

        .rules-table td {
            vertical-align: middle;
        }

        .rule-items {
            font-weight: 500;
        }

        .metric-value {
            font-weight: 600;
            text-align: center;
        }

        .interpretation {
            font-size: 0.9rem;
        }

        .positive-relation {
            color: var(--success-color);
        }

        .negative-relation {
            color: var(--danger-color);
        }

        .neutral-relation {
            color: var(--warning-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                padding: 15px;
                text-align: center;
            }
            
            .metrics-panel .col-md-4 {
                margin-bottom: 15px;
            }
            
            .admin-content {
                padding: 20px;
            }
            
            .legend {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="admin-header">
        <div class="logo-container">
            <img class="logo-img" src="<?= base_url('upload/logo.png') ?>" alt="Logo">
        </div>

        <!-- Sección del usuario (sin cambios) -->
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name"><?= session()->get('nombre') ?></div>
                <div class="user-role">Administrador</div>
            </div>
        </div>

        <!-- Nueva sección de enlaces en el header alineada a la derecha -->
        <div class="admin-navigation ms-auto">
            <a href="<?= base_url('/admin/menu') ?>" class="btn btn-outline-light">
                <i class="bi bi-house-door"></i> Menú
            </a>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger ms-2">
                <i class="bi bi-box-arrow-right"></i> Salir
            </a>
        </div>
    </header>

    <!-- Contenido principal -->
    <div class="admin-content">
        <h2 class="admin-title"><i class="bi bi-diagram-3"></i> Análisis de Reglas Apriori</h2>

        <?php if (!empty($errores)): ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle"></i> <?= esc($errores) ?>
            </div>
        <?php endif; ?>

        <!-- Panel de métricas -->
        <div class="row metrics-panel mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-box-seam"></i> Experiencias</h5>
                        <p class="card-text" id="product-count">0</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-arrow-left-right"></i> Relaciones mostradas</h5>
                        <p class="card-text" id="relation-count">0</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-list-check"></i> Reglas totales</h5>
                        <p class="card-text" id="total-rules"><?= count($reglas) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel de filtros -->
        <div class="filter-panel">
            <h3 class="filter-title"><i class="bi bi-sliders"></i> Filtros de Reglas</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="filter-group">
                        <label class="filter-label">Confianza Mínima</label>
                        <input type="range" class="form-range" id="confidence-filter" min="0" max="1" step="0.01" value="0.5">
                        <div class="filter-value">≥ <span id="confidence-value">50</span>%</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="filter-group">
                        <label class="filter-label">Soporte Mínimo</label>
                        <input type="range" class="form-range" id="support-filter" min="0" max="1" step="0.01" value="0.3">
                        <div class="filter-value">≥ <span id="support-value">30</span>%</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="filter-group">
                        <label class="filter-label">Lift Mínimo</label>
                        <input type="range" class="form-range" id="lift-filter" min="0" max="5" step="0.1" value="1">
                        <div class="filter-value">≥ <span id="lift-value">1.0</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Explicación del gráfico -->
        <div class="graph-explanation">
            <p>Este gráfico muestra <strong>qué reservas/experiencias suelen adquirirse juntas</strong>:</p>
            <ul>
                <li>Cada <strong>círculo</strong> representa una reserva o experiencia</li>
                <li>Las <strong>flechas</strong> muestran que cuando adquieren la primera, suelen adquirir la segunda</li>
                <li>El <strong>grosor</strong> de la flecha indica qué tan fuerte es esta relación</li>
                <li>El <strong>porcentaje</strong> muestra la probabilidad de que adquieran la segunda reserva/experiencia</li>
            </ul>
        </div>

        <!-- Leyenda simplificada -->
        <div class="legend">
            <div class="legend-item">
                <div class="node-legend"></div>
                <span>Reserva/Experiencia</span>
            </div>
            <div class="legend-item">
                <div class="relation-legend"></div>
                <span>Relación entre reservas</span>
            </div>
            <div class="legend-item">
                <div class="highlight-legend"></div>
                <span>Seleccionado</span>
            </div>
        </div>

        <!-- Gráfico de reglas -->
        <div id="cy"></div>

        <!-- Mensaje de interacción -->
        <div style="text-align: center; color: var(--text-muted); margin-bottom: 20px;">
            <p><i class="bi bi-mouse"></i> Haz clic en una reserva/experiencia para ver sus relaciones</p>
        </div>

        <!-- Tabla de reglas -->
        <h3 class="admin-title"><i class="bi bi-table"></i> Detalle de Reglas</h3>
        
        <?php if (!empty($reglas)): ?>
            <div class="rules-table table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th><i class="bi bi-link"></i> Regla</th>
                            <th><i class="bi bi-graph-up"></i> Soporte (%)</th>
                            <th><i class="bi bi-check-circle"></i> Confianza (%)</th>
                            <th><i class="bi bi-arrow-up-right"></i> Lift</th>
                            <th><i class="bi bi-lightbulb"></i> Interpretación</th>
                        </tr>
                    </thead>
                    <tbody id="rules-table-body">
                        <?php foreach ($reglas as $regla): ?>
                            <tr data-confidence="<?= $regla['confidence'] ?>" 
                                data-support="<?= $regla['support'] ?>" 
                                data-lift="<?= $regla['lift'] ?>">
                                <td class="rule-items">
                                    Si hay <strong><?= implode(', ', $regla['lhs']) ?></strong>,
                                    entonces también <strong><?= implode(', ', $regla['rhs']) ?></strong>
                                </td>
                                <td class="metric-value">
                                    <?= round($regla['support'] * 100, 2) ?>
                                </td>
                                <td class="metric-value">
                                    <?= round($regla['confidence'] * 100, 2) ?>
                                </td>
                                <td class="metric-value">
                                    <?= round($regla['lift'], 2) ?>
                                </td>
                                <td class="interpretation">
                                    <?php
                                        $lift = $regla['lift'];
                                        if ($lift > 1) {
                                            echo '<span class="positive-relation">Relación positiva significativa <i class="bi bi-arrow-up-right"></i></span>';
                                        } elseif ($lift < 1) {
                                            echo '<span class="negative-relation">Relación negativa <i class="bi bi-arrow-down-right"></i></span>';
                                        } else {
                                            echo '<span class="neutral-relation">Sin relación significativa <i class="bi bi-dash"></i></span>';
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle"></i> No se encontraron reglas que cumplan con los umbrales dados.
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Datos de las reglas
        const allRules = <?= json_encode($reglas) ?>;
        let cy;
        
        // Función para inicializar el gráfico
        function initGraph(confidenceThreshold = 0.5, supportThreshold = 0.3, liftThreshold = 1) {
            const elementos = [];
            const nodeSet = new Set();
            let edgeCount = 0;
            
            // Filtrar reglas según umbrales
            const filteredRules = allRules.filter(rule => 
                rule.confidence >= confidenceThreshold && 
                rule.support >= supportThreshold && 
                rule.lift >= liftThreshold
            );
            
            // Procesar reglas y crear elementos del gráfico
            filteredRules.forEach((rule, index) => {
                // Agregar nodos (reservas/experiencias)
                rule.lhs.forEach(item => {
                    if (!nodeSet.has(item)) {
                        nodeSet.add(item);
                        elementos.push({
                            data: { 
                                id: item, 
                                label: item,
                                tooltip: `Reserva/Experiencia: ${item}\n\nAparece en ${countRulesWithItem(item)} reglas`
                            }
                        });
                    }
                });
                
                rule.rhs.forEach(item => {
                    if (!nodeSet.has(item)) {
                        nodeSet.add(item);
                        elementos.push({
                            data: { 
                                id: item, 
                                label: item,
                                tooltip: `Reserva/Experiencia: ${item}\n\nAparece en ${countRulesWithItem(item)} reglas`
                            }
                        });
                    }
                });
                
                // Crear conexiones (edges)
                if (rule.lhs.length === 1 && rule.rhs.length === 1) {
                    edgeCount++;
                    elementos.push({
                        data: {
                            id: `edge${edgeCount}`,
                            source: rule.lhs[0],
                            target: rule.rhs[0],
                            confidence: rule.confidence,
                            support: rule.support,
                            lift: rule.lift,
                            label: `${(rule.confidence*100).toFixed(0)}%`,
                            tooltip: `Regla: ${rule.lhs[0]} → ${rule.rhs[0]}\n\n` +
                                     `Probabilidad: ${(rule.confidence*100).toFixed(0)}%\n` +
                                     `Frecuencia: ${(rule.support*100).toFixed(0)}% de los casos\n` +
                                     `Lift: ${rule.lift.toFixed(2)}\n\n` +
                                     `${getInterpretation(rule.lift)}`
                        }
                    });
                }
            });
            
            // Actualizar contadores
            updateCounters(nodeSet.size, edgeCount);
            
            // Crear o actualizar el gráfico
            if (!cy) {
                cy = cytoscape({
                    container: document.getElementById('cy'),
                    elements: elementos,
                    style: [
                        {
                            selector: 'node',
                            style: {
                                'background-color': '#3498db',
                                'label': 'data(label)',
                                'color': '#fff',
                                'text-valign': 'center',
                                'text-halign': 'center',
                                'width': 40,
                                'height': 40,
                                'font-size': 12
                            }
                        },
                        {
                            selector: 'edge',
                            style: {
                                'width': 'mapData(confidence, 0, 1, 1, 5)',
                                'line-color': '#2ecc71',
                                'target-arrow-color': '#2ecc71',
                                'target-arrow-shape': 'triangle',
                                'curve-style': 'bezier',
                                'label': 'data(label)',
                                'font-size': 10,
                                'text-background-opacity': 1,
                                'text-background-color': '#fff',
                                'text-background-shape': 'roundrectangle'
                            }
                        },
                        {
                            selector: 'node.highlighted',
                            style: {
                                'background-color': '#e74c3c'
                            }
                        },
                        {
                            selector: 'edge.highlighted',
                            style: {
                                'width': 6,
                                'line-color': '#e74c3c',
                                'target-arrow-color': '#e74c3c'
                            }
                        }
                    ],
                    layout: {
                        name: 'circle',
                        animate: true,
                        animationDuration: 1000,
                        fit: true,
                        padding: 50
                    }
                });
                
                // Eventos de interacción
                cy.on('tap', 'node', function(evt) {
                    const node = evt.target;
                    cy.elements().removeClass('highlighted');
                    node.connectedEdges().addClass('highlighted');
                    node.addClass('highlighted');
                    node.neighborhood().addClass('highlighted');
                });
                
                cy.on('tap', 'edge', function(evt) {
                    const edge = evt.target;
                    cy.elements().removeClass('highlighted');
                    edge.addClass('highlighted');
                    edge.source().addClass('highlighted');
                    edge.target().addClass('highlighted');
                });
                
                // Mostrar tooltips
                cy.on('mouseover', 'node, edge', function(evt) {
                    const ele = evt.target;
                    const tooltip = ele.data('tooltip');
                    if (tooltip) {
                        const div = document.createElement('div');
                        div.innerHTML = tooltip.replace(/\n/g, '<br>');
                        ele.popperRef = ele.popper({
                            content: div
                        });
                    }
                });
                
                cy.on('mouseout', 'node, edge', function(evt) {
                    if (evt.target.popperRef) {
                        evt.target.popperRef.destroy();
                        evt.target.popperRef = null;
                    }
                });
                
                // Configurar controles
                document.getElementById('confidence-filter').addEventListener('input', function() {
                    document.getElementById('confidence-value').textContent = (this.value*100).toFixed(0);
                    updateFilters();
                });
                
                document.getElementById('support-filter').addEventListener('input', function() {
                    document.getElementById('support-value').textContent = (this.value*100).toFixed(0);
                    updateFilters();
                });
                
                document.getElementById('lift-filter').addEventListener('input', function() {
                    document.getElementById('lift-value').textContent = parseFloat(this.value).toFixed(1);
                    updateFilters();
                });
            } else {
                // Actualizar grafo existente
                cy.elements().remove();
                cy.add(elementos);
                cy.layout({
                    name: 'circle',
                    animate: true,
                    animationDuration: 800
                }).run();
            }
            
            // Filtrar tabla
            filterTable(confidenceThreshold, supportThreshold, liftThreshold);
        }
        
        // Función para actualizar contadores
        function updateCounters(products, relations) {
            document.getElementById('product-count').textContent = products;
            document.getElementById('relation-count').textContent = relations;
            
            // Animación de los contadores
            animateCounter('product-count', products);
            animateCounter('relation-count', relations);
        }
        
        // Animación simple para los contadores
        function animateCounter(id, finalValue) {
            const element = document.getElementById(id);
            const duration = 500;
            const start = 0;
            const increment = finalValue / (duration / 16);
            
            let current = start;
            const timer = setInterval(() => {
                current += increment;
                if (current >= finalValue) {
                    clearInterval(timer);
                    current = finalValue;
                }
                element.textContent = Math.floor(current);
            }, 16);
        }
        
        // Función para contar en cuántas reglas aparece un ítem
        function countRulesWithItem(item) {
            let count = 0;
            allRules.forEach(rule => {
                if (rule.lhs.includes(item) || rule.rhs.includes(item)) count++;
            });
            return count;
        }
        
        // Función para obtener interpretación del lift
        function getInterpretation(lift) {
            if (lift > 1) return "Relación positiva significativa (mayor probabilidad de ocurrir juntos)";
            if (lift < 1) return "Relación negativa (menor probabilidad de ocurrir juntos)";
            return "No hay relación significativa (ocurren independientemente)";
        }
        
        // Función para filtrar la tabla
        function filterTable(confidenceThreshold, supportThreshold, liftThreshold) {
            const rows = document.querySelectorAll('#rules-table-body tr');
            let visibleCount = 0;
            
            rows.forEach(row => {
                if (row.classList.contains('no-rules-alert')) return;
                
                const confidence = parseFloat(row.getAttribute('data-confidence'));
                const support = parseFloat(row.getAttribute('data-support'));
                const lift = parseFloat(row.getAttribute('data-lift'));
                
                if (confidence >= confidenceThreshold && 
                    support >= supportThreshold && 
                    lift >= liftThreshold) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Mostrar mensaje si no hay reglas visibles
            const noRulesAlert = document.querySelector('#rules-table-body .no-rules-alert');
            if (visibleCount === 0 && !noRulesAlert) {
                const alertRow = document.createElement('tr');
                alertRow.classList.add('no-rules-alert');
                alertRow.innerHTML = `
                    <td colspan="5" class="text-center text-muted py-3">
                        No hay reglas que cumplan con los filtros actuales
                    </td>
                `;
                document.querySelector('#rules-table-body').appendChild(alertRow);
            } else if (visibleCount > 0 && noRulesAlert) {
                noRulesAlert.remove();
            }
        }
        
        // Función para actualizar filtros
        function updateFilters() {
            const confidence = parseFloat(document.getElementById('confidence-filter').value);
            const support = parseFloat(document.getElementById('support-filter').value);
            const lift = parseFloat(document.getElementById('lift-filter').value);
            initGraph(confidence, support, lift);
        }
        
        // Inicializar el gráfico
        document.addEventListener('DOMContentLoaded', function() {
            initGraph();
        });
    </script>
</body>
</html>