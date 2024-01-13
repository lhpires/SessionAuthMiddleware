
## Autenticação na WEB

Exemplo de uma requisição que envia email e senha para autenticação na tabela users

No controlador temos a facade `Auth` ela vai ser responsável por devolver como um true ou false se esse usuário é válido e existe no banco de dados

<aside>
💡 Com a injeção Request, vamos receber esses parâmetros e validar

</aside>

```jsx
$credentials = [
    "email" => $request->get('email'),
    "password" => $request->get('password')
];

// Retorna True ou False, baseado na tabela users
$attempt = Auth::attempt($credentials);
```

Devolvendo um erro e também os valores old dos inputs

Conseguimos resgatar isso com a variável $errors e old(’email’) no input

```jsx
return back()->withErrors([
	'message' => "Os dados informados não conferem!"
])->withInput($request->only('email'));
```

Se a validação for true

```jsx
if($attempt){
	Session::regenerateToken();
	return redirect()->route('admin.dashboard');
}
```

Podemos ter acesso ao usuário logado de duas maneiras

No front - pelo helper auth()

```jsx
dump(auth()->user())
```

Pelo controlador

```jsx
Auth::user();
```

Implementando o Logout

```jsx
public function logout()
{
    Auth::logout();
    Session::invalidate()
    Session::regenerateToken();
    
    return redirect()->route('admin.login');
}
```

### Utilizando middleware para autenticação auth:sanctum

```jsx
Route::group(["middleware" => "auth:sanctum"],function (){
	Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');
});
```

<aside>
⚠️ Caso precise, acesse app/Http/Middleware/Authenticate.php, e troque a rota padrão de retorno

</aside>

## Autenticação API

Na web a autenticação é baseada na Sessão, no ambiente API a autenticação é baseada em token

Obviamente não temos visões

Implementação de uma geração de token

```php
public function attempt(Request $request)
{
    $credentials = [
        "email" => $request->get('email'),
        "password" => $request->get('password')
    ];

    // Retorna True ou False
    $attempt = Auth::attempt($credentials);
    if($attempt){
        return response()->json([
            "user" => Auth::user(),
            "token" => Auth::user()->createToken('authorization')->plainTextToken
        ]);
    }
    return response()->json([
        "message" => "Os dados não conferem"
    ],401);
}
```

Implementação de Logout

** A rota logout tem que passar pelo middleware para poder conseguir localizar o usuário que está logando na aplicação

Controller

```php
public function logout() : void
{
    $user = Auth::user();
    $user->tokens()->delete(); // Exclui todos os tokens do usuário
    $user->currentAccessToken()->delete(); // Exclui apenas o token passado na requisição
}
```

## Autenticação SPA

Feita por Token locado no Cookie

Precisamos configurar os domínios da SPA em config/sanctum.php

Como a requisição é feita com cookie e não com token bearer, precisamos mudar as rotas para o web.php (Para retornar o json de users autenticado)

Exemplo requisição axios no js da aplicação SPA

```php
async function getUser() {
  return await axios.get('http://localhost/api/user').then( (data) => {
      console.log(data);
      alert(data);
  })
};
```

Se estivermos logados certinho e o domínio cadastrados na configuração do sanctum, os dados são retornados de forma correta

## Middlewares

As configurações gerais dos middleware estão em app/http/Kernel.php

## Criando um Middleware de log

Passo 1 - Criação

```php
sail artisan make:middleware LogPires
```

Passo 2 - (Opcional) - Criando alias do Middleware

Em Kernel.php declarar o middleware criado para você poder usar de forma facilitada nas rotas

Passo 3 - Dois métodos declarativos aplicando em rotas

```php
Route::get('mid',function (){
    \Illuminate\Support\Facades\Log::debug("Estou na requisição");
})->middleware(['logPiresKernel:true']);

Route::middleware(['logPiresKernel'])->get('mid2',function (){
    \Illuminate\Support\Facades\Log::debug("Estou na req mid2 e não vou executar nada depois pq n vou passar parêmetro true");
});
```

Passando parametros para a classe dos middlewares (Por rotas)

```php
['logPiresKernel:true']
```

Exemplo da implementação acima

LogPires Middleware

```php
public function handle(Request $request, Closure $next, bool $active = false): Response
{
    // ANTES DA REQUISIÇÃO
    Log::debug("Estou executando antes da requisição");

    // Guardando a resposta para aplicarmos a execução de código após a requisição
    $response = $next($request);

    // DEPOIS DA REQUISIÇÃO
    if($active === true) Log::debug("Estou executando DEPOIS da requisição");

    return $response;
}
```

Com as rotas declaradas acima, esse foi os logs gerados após acessarmos mid e mid2

```php
[2024-01-13 15:30:19] local.DEBUG: Estou executando antes da requisição
[2024-01-13 15:30:19] local.DEBUG: Estou na requisição
[2024-01-13 15:30:19] local.DEBUG: Estou executando DEPOIS da requisição
```

```php
[2024-01-13 15:32:04] local.DEBUG: Estou executando antes da requisição
[2024-01-13 15:32:04] local.DEBUG: Estou na req mid2 e não vou executar nada depois pq n vou passar parêmetro true
```

## Aplicação com DOIS paineis (Sanctum AUTH)

**admin**

`lucas@pires.dev.br`

`lucas`

**master**

`kingo@pires.dev.br`

`kingophp`

**Middlewares**

VerifyIsAdmin

VerifyIsMaster

```php
sail artisan migrate
```

```php
sail artisan db:seed
```

```php
sail npm run build
```