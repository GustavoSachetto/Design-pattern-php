<?php

/* ================ COMMAND ================= */

// ((( Interface Command )))

/**
 * Aqui definimos todos os métodos que deveram ser implementados uma lógica. 
 */

interface Command
{
    public function execute(): void;
}

// ((( Concrete Command )))

/**
 * Criamos uma classe concreta, fornecendo as implementações da interface do comando.
 */

class SimpleCommand implements Command 
{
    public function __construct(
        private int $num1,
        private int $num2
    ) {}

    public function execute(): void
    {
        echo "<pre>Comando simples</pre>";
        echo $this->num1 + $this->num2;
    }       
}

class ComplexCommand implements Command 
{
    public function __construct(
        private int $num1,
        private int $num2,
        private Calculator $calculator
    ) {}

    public function execute(): void
    {
        echo "<pre>Comando complexo</pre>";
        $this->calculator->pow($this->num1, $this->num2);
    }       
}

// ((( Receiver )))

/**
 * Uma classe comum que apresenta calculos sobre potência, na qual não é 
 * obrigatório sua implementação e foi utilizada apenas para uso do exemplo. 
 */

class Calculator 
{
    public function pow(int $num1, int $num2): void
    {
        echo $num1 ** $num2;
    }
}

// ((( Invoker )))

/**
 * Criamos um invocador, quer irá setar e orderar os comandos que serão executados.
 */

class Invoker 
{
    private array $commands = [];

    public function setCommand(Command $command): void
    {
        $this->commands[] = $command;
    }

    public function executeCommands(): void
    {
        foreach ($this->commands as $command) {
            $command->execute();
        }
    }
}

$invoker = new Invoker;
$invoker->setCommand(new SimpleCommand(10, 15));

$calculator = new Calculator;
$invoker->setCommand(new ComplexCommand(10, 4, $calculator));
$invoker->setCommand(new ComplexCommand(2, 4, $calculator));

$invoker->executeCommands();

/* ========================================== */