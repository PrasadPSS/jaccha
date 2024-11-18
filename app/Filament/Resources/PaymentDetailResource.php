<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentDetailResource\Pages;
use App\Filament\Resources\PaymentDetailResource\RelationManagers;
use App\Models\PaymentDetail;
use Filament\Forms;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentDetailResource extends Resource
{
    protected static ?string $model = PaymentDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_id'),
                TextColumn::make('amount'),
                ToggleColumn::make('status')->label('Is_Completed')
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
            'index' => Pages\ListPaymentDetails::route('/'),
            'create' => Pages\CreatePaymentDetail::route('/create'),
            'edit' => Pages\EditPaymentDetail::route('/{record}/edit'),
        ];
    }
}
