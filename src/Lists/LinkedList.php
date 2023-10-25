<?php

declare(strict_types=1);

namespace Opmvpc\StructuresDonnees\Lists;

use Opmvpc\StructuresDonnees\Node;

class LinkedList implements ListInterface
{
    protected Node $head;
    protected int $size;

    public function __construct()
    {
        $this->head = new Node(null);
        $this->size = 0;
    }

    public function __toString(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }

    public function push(mixed $element): void {
        // Créez un nouveau nœud avec l'élément fourni
        $newNode = new Node($element);

        // Si la liste est vide
        if ($this->size == 0) {
            $this->head->setNext($newNode);
        } else {
            // Parcourez la liste jusqu'au dernier nœud
            $currentNode = $this->head;
            while ($currentNode->getNext() !== null) {
                $currentNode = $currentNode->getNext();
            }
            // Ajoutez le nouveau nœud à la fin de la liste
            $currentNode->setNext($newNode);
        }

        // Incrémentez la taille de la liste
        $this->size++;
    }

    public function get(int $index): mixed {
        // Vérifiez que l'index est valide
        if ($index < 0 || $index >= $this->size) {
            throw new \OutOfRangeException('Index is out of range');
        }

        // Commencez au premier nœud (head) 
        $currentNode = $this->head->getNext(); // car la tête ne contient pas de donnée utile
        $currentIndex = 0;

        // Parcourez la liste jusqu'à atteindre l'indice demandé
        while ($currentIndex < $index && $currentNode !== null) {
            $currentNode = $currentNode->getNext();
            $currentIndex++;
        }

        // Vérifiez que le nœud actuel n'est pas null avant d'essayer d'appeler une méthode dessus
        if ($currentNode === null) {
            throw new \RuntimeException('Unexpected error: Node is null.');
        }

        // Une fois que vous avez atteint l'indice demandé, retournez l'élément du nœud
        return $currentNode->getElement();
    }

    public function set(int $index, mixed $element): void {

        /* // Initialisez une variable pour stocker le nœud actuel et le décalage
            $nodeCurrent = $this->head; */
    }

    public function clear(): void {
        // Réinitialisez le head à un nouveau nœud avec une valeur null
        $this->head = new Node(null);

        // Réinitialisez la taille à 0
        $this->size = 0;
    }

    public function includes(mixed $element): bool {
        // Commencez par vérifier si le head a une valeur null ou non
    }

    public function isEmpty(): bool {}

    public function indexOf(mixed $element): int {}

    public function remove(int $index): void {
        // Vérifiez que l'index est valide
        if ($index < 0 || $index >= $this->size) {
            throw new \OutOfRangeException('Index is out of range');
        }

        $previousNode = $this->head;
        $currentNode = $this->head->getNext();
        $currentIndex = 0;

        // Parcourez la liste jusqu'à atteindre l'indice demandé
        while ($currentIndex < $index && $currentNode !== null) {
            $previousNode = $currentNode;
            $currentNode = $currentNode->getNext();
            $currentIndex++;
        }

        // Si le nœud actuel est nul, cela signifie que nous avons un problème (mais cela ne devrait pas arriver car nous avons vérifié l'indice au début)
        if ($currentNode === null) {
            throw new \RuntimeException('Unexpected error: Node is null.');
        }

        // Ajustez la référence du nœud précédent pour qu'elle pointe vers le nœud après le nœud actuel
        $previousNode->setNext($currentNode->getNext());

        // Decrement the size of the list
        $this->size--;
    }

    public function size(): int {
        return $this->size;
    }

    public function toArray(): array {}
}
