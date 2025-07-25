<?php
namespace App\Libraries;

class KMeans
{
    private $k;
    private $maxIterations;
    private $centroids;
    private $clusters;

    public function __construct(int $maxIterations = 100)
    {
        $this->k = null;
        $this->maxIterations = $maxIterations;
        $this->centroids = [];
        $this->clusters = [];
        $this->optimalK = null;
        $this->sseValues = [];
    }

    /**
     * Ejecuta el método del codo para determinar el k óptimo y lo asigna a $this->optimalK.
     */
    public function determineOptimalK(array $data, int $maxK = 10)
    {
        $this->sseValues = $this->elbowMethod($data, $maxK);
        // Aquí podrías implementar lógica para seleccionar automáticamente el k óptimo basado en la curva SSE.
        // Por simplicidad, asignamos el k con la mayor caída relativa en SSE.
        $this->optimalK = $this->findElbowPoint($this->sseValues);
        $this->k = $this->optimalK;
    }

    /**
     * Retorna el k óptimo determinado.
     */
    public function getOptimalK()
    {
        return $this->optimalK;
    }

    /**
     * Retorna los valores SSE calculados para cada k.
     */
    public function getSSEValues()
    {
        return $this->sseValues;
    }

    /**
     * Encuentra el punto del codo en la curva SSE.
     * Implementación simple que busca la mayor caída relativa.
     */
    private function findElbowPoint(array $sseValues)
    {
        $maxDrop = 0;
        $elbowK = 1;
        $prevSSE = null;
        foreach ($sseValues as $k => $sse) {
            if ($prevSSE !== null) {
                $drop = $prevSSE - $sse;
                if ($drop > $maxDrop) {
                    $maxDrop = $drop;
                    $elbowK = $k;
                }
            }
            $prevSSE = $sse;
        }
        return $elbowK;
    }

    /**
     * Método del codo para encontrar el k óptimo.
     * Ejecuta k-means para valores de k desde 1 hasta maxK y calcula la suma de errores cuadráticos (SSE).
     * Retorna un array con los valores de SSE para cada k.
     */
    public function elbowMethod(array $data, int $maxK = 10): array
    {
        $sseValues = [];

        for ($k = 1; $k <= $maxK; $k++) {
            $this->k = $k;
            $this->fit($data);
            $sse = $this->calculateSSE($data);
            $sseValues[$k] = $sse;
        }

        return $sseValues;
    }

    /**
     * Calcula la suma de errores cuadráticos (SSE) para los clusters actuales.
     */
    private function calculateSSE(array $data): float
    {
        $sse = 0.0;
        foreach ($data as $index => $point) {
            $clusterIndex = $this->clusters[$index];
            $centroid = $this->centroids[$clusterIndex];
            $distance = $this->euclideanDistance($point, $centroid);
            $sse += $distance * $distance;
        }
        return $sse;
    }

    public function fit(array $data)
    {
        if (empty($data) || !$this->k) {
            return;
        }

        // Initialize centroids randomly from data points
        $this->centroids = $this->initializeCentroids($data);

        for ($i = 0; $i < $this->maxIterations; $i++) {
            // Assign clusters
            $this->clusters = $this->assignClusters($data);
            // Recalculate centroids
            $newCentroids = $this->calculateCentroids($data, $this->clusters);
            if ($this->hasConverged($this->centroids, $newCentroids)) {
                break;
            }
            $this->centroids = $newCentroids;
        }
    }
    
    public function getClusters()
    {
        return $this->clusters;
    }

    public function getCentroids()
    {
        return $this->centroids;
    }

    private function initializeCentroids(array $data)
    {
        $centroids = [];
        $keys = array_rand($data, $this->k);
        if ($this->k == 1) {
            $keys = [$keys];
        }
        foreach ($keys as $key) {
            $centroids[] = $data[$key];
        }
        return $centroids;
    }

    private function assignClusters(array $data)
    {
        $clusters = [];
        foreach ($data as $index => $point) {
            $closestCentroid = null;
            $minDistance = PHP_FLOAT_MAX;
            foreach ($this->centroids as $centroidIndex => $centroid) {
                $distance = $this->euclideanDistance($point, $centroid);
                if ($distance < $minDistance) {
                    $minDistance = $distance;
                    $closestCentroid = $centroidIndex;
                }
            }
            $clusters[$index] = $closestCentroid;
        }
        return $clusters;
    }

    private function calculateCentroids(array $data, array $clusters)
    {
        $centroids = array_fill(0, $this->k, null);
        $counts = array_fill(0, $this->k, 0);

        foreach ($clusters as $index => $clusterIndex) {
            if ($centroids[$clusterIndex] === null) {
                $centroids[$clusterIndex] = array_fill(0, count($data[0]), 0);
            }
            foreach ($data[$index] as $dim => $value) {
                $centroids[$clusterIndex][$dim] += $value;
            }
            $counts[$clusterIndex]++;
        }

        foreach ($centroids as $i => $centroid) {
            if ($counts[$i] > 0) {
                foreach ($centroid as $dim => $value) {
                    $centroids[$i][$dim] = $value / $counts[$i];
                }
            }
        }

        return $centroids;
    }

    private function hasConverged(array $oldCentroids, array $newCentroids, float $tolerance = 0.0001)
    {
        for ($i = 0; $i < $this->k; $i++) {
            if ($this->euclideanDistance($oldCentroids[$i], $newCentroids[$i]) > $tolerance) {
                return false;
            }
        }
        return true;
    }

    private function euclideanDistance(array $point1, array $point2)
    {
        $sum = 0;
        foreach ($point1 as $i => $value) {
            $sum += pow($value - $point2[$i], 2);
        }
        return sqrt($sum);
    }

}