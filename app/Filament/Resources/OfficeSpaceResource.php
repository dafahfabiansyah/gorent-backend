<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficeSpaceResource\Pages;
use App\Filament\Resources\OfficeSpaceResource\RelationManagers;
use App\Models\OfficeSpace;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfficeSpaceResource extends Resource
{
    protected static ?string $model = OfficeSpace::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(255),

                TextInput::make('address')
                ->required()
                ->maxLength(255),

                FileUpload::make('thumbnail')
                ->image()
                ->required(),

                Textarea::make('description')
                ->rows(10)
                ->cols(20)
                ->required(),

                Repeater::make('images')
                ->relationship('images')
                ->schema([
                    FileUpload::make('image')
                    ->required(),
                ]),

                Repeater::make('benefits')
                ->relationship('benefits')
                ->schema([
                    TextInput::make('name')
                    ->required(),
                ]),
                
                Select::make('city_id')
                ->relationship('city', 'name')
                ->searchable()
                ->preload()
                ->required(),

                TextInput::make('price')
                ->prefix('IDR')
                ->numeric()
                ->required(),

                TextInput::make('duration')
                ->prefix('Days')
                ->numeric()
                ->required(),

                Select::make('is_open')
                ->options([
                    true => 'Open',
                    false => 'Closed',
                ])
                ->required(),

                Select::make('is_available')
                ->options([
                    true => 'Available',
                    false => 'Not available',
                ])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->sortable(),

                TextColumn::make('name')
                ->searchable(),

                ImageColumn::make('thumbnail'),

                IconColumn::make('is_available')
                ->boolean(),

                IconColumn::make('is_open')
                ->boolean(),
            ])
            ->filters([
                SelectFilter::make('city_id')
                ->label('City')
                ->relationship('city', 'name'),

                SelectFilter::make('is_open')
                ->label('Status')
                ->options([
                    1 => 'Open',
                    0 => 'Closed',
                ]),

                SelectFilter::make('is_available')
                ->label('Status')
                ->options([
                    1 => 'Available',
                    0 => 'Not available',
                ])
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
            'index' => Pages\ListOfficeSpaces::route('/'),
            'create' => Pages\CreateOfficeSpace::route('/create'),
            'edit' => Pages\EditOfficeSpace::route('/{record}/edit'),
        ];
    }
}
