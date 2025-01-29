<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Campo para el nombre de la categoría
            Forms\Components\TextInput::make('name')
            ->label('Nombre')
            ->required()
            ->maxLength(255),

        // Campo para la descripción de la categoría
        Forms\Components\TextInput::make('description')
            ->label('Descripción')
            ->nullable()
            ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 // Mostrar la columna 'name'
            Tables\Columns\TextColumn::make('name')
            ->label('Nombre')
            ->searchable(),  // Hacer que esta columna sea buscable

        // Mostrar la columna 'description'
        Tables\Columns\TextColumn::make('description')
            ->label('Descripción')
            ->limit(50),  // Limitar el texto que se muestra
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
