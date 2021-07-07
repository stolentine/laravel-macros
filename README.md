#Макросы

## Миграции

###Типы

1. Создание типа (Enum)
```php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

Schema::table('', function (Blueprint $table) {
    $table->createType('claim_document_types')
        ->enum(['contract', 'act', 'ttn', 'check']);
});
```

2. Удаление типа

```php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

Schema::table('', function (Blueprint $table) {
    $table->dropType('claim_document_types')->ifExists();
});
```



###Столбцы

1. Столбец с произвольным типом.
```php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

Schema::create('claim_documents', function (Blueprint $table) {
     $table->addColumnRaw('claim_document_types', 'type');
});
```
Удаляется как обычный столбец.



###Кастомный уникальный индекс

1. Создание.
```php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

Schema::create('table', function (Blueprint $table) {
    $table->customUnique('column');
    $table->customUnique('column', 'index_name');
    $table->customUnique(['column1', 'column2']);
    $table->customUnique(['column1', 'column2'], 'index_name');
    
    $table->customUnique('inn')
        ->where('deleted_at', 'is', null)
        ->where('create_at', 'is', null, 'or');
        
    $table->customUnique('inn')
        ->whereIsNull('create_at');

    // только для deleted_at
    $table->customUnique('inn')
        ->whereDeletedAtIsNull(); 
});
```


###Кастомное удаление индекса
Если существует
```php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

Schema::create('table', function (Blueprint $table) {
    $table->customDropIndex('index_name')->ifExists();
    $table->customDropIndex(['column'])->ifExists();
    $table->customDropIndex(['column1', 'column2'])->ifExists();
});
```

### Constraint
1. Добавление

```php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Builder;

Schema::table('table', function (Blueprint $table) {
    $table->addConstraint(['amount'])->check('amount >= 0 OR amount IS NULL');
    $table->addConstraint('table_not_negative_amount_check')->check('amount >= 0 OR amount IS NULL');

    $table->addConstraint(['amount'])->check(fn (Builder $q) => $q
        ->where(fn (Builder $q) => $q
            ->where('amount', '>=', 0)
            ->orWhereNull('amount')
        )
    );

});
```

1. Удаление

```php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

Schema::table('table', function (Blueprint $table) {
    $table->dropConstraint(['amount']);
    $table->dropConstraint('table_not_negative_amount_check');
});
```

            
