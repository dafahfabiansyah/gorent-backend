<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingTransactionResource\Pages;
use App\Filament\Resources\BookingTransactionResource\RelationManagers;
use App\Models\BookingTransaction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BookingTransactionResource extends Resource
{
    protected static ?string $model = BookingTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(255),

                TextInput::make('booking_trx_id')
                ->label('Booking Transaction ID')
                ->required()
                ->maxLength(255),

                TextInput::make('phone_number')
                ->required()
                ->maxLength(255),

                TextInput::make('total_amount')
                ->required()
                ->numeric()
                ->prefix('IDR'),

                TextInput::make('duration')
                ->required()
                ->numeric()
                ->prefix('Days'),

                DatePicker::make('started_at')
                ->required(),

                DatePicker::make('ended_at')
                ->required(),

                Select::make('is_paid')
                ->options([
                    true => 'Paid',
                    false => 'Not paid',
                ]),

                Select::make('office_space_id')
                ->relationship('officeSpace', 'name')
                ->searchable()
                ->preload()
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking_trx_id')
                ->searchable(),

                TextColumn::make('name')
                ->searchable(),

                TextColumn::make('officeSpace.name'),

                TextColumn::make('started_at')
                ->date(),
                TextColumn::make('ended_at')
                ->date(),

                IconColumn::make('is_paid')
                ->boolean(),
            ])
            ->filters([
                SelectFilter::make('is_paid')
                ->label('Status')
                ->options([
                    1 => 'Paid',
                    0 => 'Not paid',
                ]),
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
            'index' => Pages\ListBookingTransactions::route('/'),
            'create' => Pages\CreateBookingTransaction::route('/create'),
            'edit' => Pages\EditBookingTransaction::route('/{record}/edit'),
        ];
    }
}
