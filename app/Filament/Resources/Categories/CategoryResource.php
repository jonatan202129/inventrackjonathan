<?php

namespace App\Filament\Resources\Categories;

use Filament\Forms;
use Filament\Tables;
use Filament\Actions;
use App\Filament\Resources\Categories\Pages\CreateCategory;
use App\Filament\Resources\Categories\Pages\EditCategory;
use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Filament\Resources\Categories\Schemas\CategoryForm;
use App\Filament\Resources\Categories\Tables\CategoriesTable;
use App\Models\Category;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Category';

    public static function form(Schema $schema): Schema
{
    return $schema
        ->components([
            Forms\Components\TextInput::make('nama_kategori')
                ->label('Nama Kategori')
                ->placeholder('Contoh: Elektronik, Furniture, ATK')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('deskripsi')
                ->label('Deskripsi Kategori')
                ->placeholder('Jelaskan singkat tentang kategori ini')
                ->required()
                ->rows(3),

            Forms\Components\FileUpload::make('image')
                ->label('Foto Kategori')
                ->image()
                ->directory('categories')
                ->visibility('public')
                ->required(),
        ]);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\ImageColumn::make('image')
                ->label('Foto')
                ->disk('public'),

            Tables\Columns\TextColumn::make('nama_kategori')
                ->label('Kategori')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('deskripsi')
                ->label('Deskripsi')
                ->limit(50),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Ditambahkan')
                ->dateTime('d M Y')
                ->sortable(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Actions\BulkActionGroup::make([
                Actions\DeleteBulkAction::make(),
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
