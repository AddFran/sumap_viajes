<?php
namespace App\Libraries;

class KMeans
{
    private $k;
    private $maxIterations;
    private $centroids;
    private $clusters;

    public function __construct(int $k = 3, int $maxIterations = 100)
    {
        $this->k = $k;
        $this->maxIterations = $maxIterations;
        $this->centroids = [];
        $this->clusters = [];
    }

    public function fit(array $data)
    {
        if (empty($data)) {
            return;
        }

        // Initialize centroids randomly from data points
        $this->centroids = $this->initializeCentroids($data);

        for ($i = 0; $i < $this->maxIterations; $i++) {
            // Assign clusters
            $this->clusters = $this->assignClusters($data);

            // Calculate new centroids
            $newCentroids = $this->calculateCentroids($data, $this->clusters);

            // Check for convergence
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
