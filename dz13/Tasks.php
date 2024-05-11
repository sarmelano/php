<?php

// Define a class for the task states
class TaskState {
    const COMPLETED = 'completed';
    const NOT_COMPLETED = 'not completed';
}

// Define the TaskManager class
class TaskManager {
    private array $tasks = [];
    private string $filePath = 'tasks.json';

    public function __construct() {
        $this->loadTasks();
    }

    private function loadTasks(): void {
        if (file_exists($this->filePath)) {
            $jsonContent = file_get_contents($this->filePath);
            $this->tasks = json_decode($jsonContent, true) ?? [];
        }
    }

    private function saveTasks(): void {
        $jsonContent = json_encode($this->tasks);
        file_put_contents($this->filePath, $jsonContent);
    }

    public function addTask(string $taskName, int $priority): void {
        $newTask = [
            'id' => $this->generateUniqueId(),
            'name' => $taskName,
            'priority' => $priority,
            'state' => TaskState::NOT_COMPLETED
        ];
        $this->tasks[] = $newTask;
        $this->saveTasks();
    }

    public function deleteTask(string $taskId): void {
        foreach ($this->tasks as $index => $task) {
            if ($task['id'] === $taskId) {
                unset($this->tasks[$index]);
                break;
            }
        }
        $this->saveTasks();
    }

    public function completeTask(string $taskId): void {
        foreach ($this->tasks as &$task) {
            if ($task['id'] === $taskId && $task['state'] === TaskState::NOT_COMPLETED) {
                $task['state'] = TaskState::COMPLETED;
                break;
            }
        }
        $this->saveTasks();
    }

    public function getTasks(): array {
        usort($this->tasks, fn($a, $b) => $b['priority'] - $a['priority']);
        return $this->tasks;
    }

    private function generateUniqueId(): string {
        return uniqid();
    }
}

// Example usage
$taskManager = new TaskManager();
$taskManager->addTask('Buy milk', 2);
$taskManager->addTask('Submit report', 1);
$taskManager->completeTask('5f1d7f3e7f8b9'); // Sample ID, use actual ID from your list
$tasks = $taskManager->getTasks();
print_r($tasks);