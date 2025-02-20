Ótimo, Wellington! Kotlin é uma linguagem moderna e fácil de aprender, especialmente se você já tem alguma noção de programação. Vou te ajudar a começar do zero.  

### **1. Instalando o Kotlin**  
Você pode rodar Kotlin de várias formas:  
- **Online**: Acesse o [Kotlin Playground](https://play.kotlinlang.org/) e comece a testar código sem precisar instalar nada.  
- **No PC**:  
  - Baixe e instale o **IntelliJ IDEA** (IDE oficial da JetBrains).  
  - Ou instale o **Kotlin Compiler** no terminal usando [SDKMAN!](https://sdkman.io/) ou [Kotlin CLI](https://kotlinlang.org/docs/command-line.html).  

### **2. Primeiro código em Kotlin**  
Se estiver no terminal, rode:  
```sh
kotlinc
```
E teste um simples **"Olá, Mundo!"**:  
```kotlin
fun main() {
    println("Olá, Mundo!")
}
```

### **3. Variáveis e Tipos**  
Kotlin tem **dois tipos principais de variáveis**:  
```kotlin
val nome = "Wellington"  // Não pode mudar (imutável)
var idade = 25           // Pode mudar (mutável)
```

### **4. Condicionais**  
```kotlin
val idade = 18

if (idade >= 18) {
    println("Você é maior de idade!")
} else {
    println("Você é menor de idade!")
}
```

### **5. Laços de Repetição (Looping)**  
```kotlin
for (i in 1..5) {
    println("Número: $i")
}
```

### **6. Funções**  
```kotlin
fun saudacao(nome: String) {
    println("Olá, $nome!")
}

fun main() {
    saudacao("Wellington")
}
```

Kotlin é muito usado para **desenvolvimento Android**, mas também serve para backend e outras aplicações. Quer focar em algo específico ou só aprender a base primeiro? 🚀