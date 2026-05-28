<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdutoResource\Pages;
use App\Filament\Resources\ProdutoResource\RelationManagers;
use App\Models\Produto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->maxLength(150),
                Forms\Components\TextInput::make('categoria')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('marca')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('codigo_barras')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('cor')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('material')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('compatibilidade')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('preco')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('quantidade_atual')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('estoque_minimo')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('garantia_estendida')
                    ->required(),
                Forms\Components\Textarea::make('descricao')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('categoria')
                    ->searchable(),
                Tables\Columns\TextColumn::make('marca')
                    ->searchable(),
                Tables\Columns\TextColumn::make('codigo_barras')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('material')
                    ->searchable(),
                Tables\Columns\TextColumn::make('compatibilidade')
                    ->searchable(),
                Tables\Columns\TextColumn::make('preco')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantidade_atual')
                    ->numeric()
                    ->sortable()
                    ->label('quantidade_atual')
                    ->badge()
                    ->color(function ($record) {
                        if ($record->quantidade_atual == 0){
                            return 'danger';
                        }
                        if ($record->quantidade_atual < $record->estoque_minimo) {
                            return 'warning';
                        }

                        return 'success';
                    }),
                Tables\Columns\TextColumn::make('estoque_minimo')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('garantia_estendida')
                    ->boolean(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListProdutos::route('/'),
            'create' => Pages\CreateProduto::route('/create'),
            'edit' => Pages\EditProduto::route('/{record}/edit'),
        ];
    }
}
