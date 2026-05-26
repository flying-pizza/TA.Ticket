<?php

namespace App\Filament\Resources\Tickets;

use App\Filament\Resources\Tickets\Pages\CreateTicket;
use App\Filament\Resources\Tickets\Pages\EditTicket;
use App\Filament\Resources\Tickets\Pages\ListTickets;
use App\Models\Ticket;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                // 1. Kolom Nama
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            // 2. Kolom WhatsApp (Tambahan Baru)
            Forms\Components\TextInput::make('whatsapp')
                ->label('Nomor WhatsApp')
                ->required(),

            // 3. Kolom Kategori Tiket (Tambahan Baru)
            Forms\Components\Select::make('kategori')
                ->options([
                    'VIP (Free Merchandise)' => '👑 VIP (Free Merchandise)',
                    'CAT 1' => '🎟️ CAT 1',
                    'CAT 2' => '🎟️ CAT 2',
                ])
                ->required(),

            // 4. Kolom Jumlah Tiket (Tambahan Baru)
            Forms\Components\TextInput::make('jumlah_tiket')
                ->numeric()
                ->default(1)
                ->required(),
                
            // 5. Kolom Status Kehadiran
            Forms\Components\Toggle::make('is_checked_in')
                ->label('Sudah Hadir')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table->columns([
        Tables\Columns\TextColumn::make('name')
            ->label('Nama Tamu')
            ->searchable(),
        Tables\Columns\TextColumn::make('qr_code')
            ->label('Kode QR'),
        Tables\Columns\TextColumn::make('whatsapp')
                ->label('No. WhatsApp')
                ->searchable(),
        Tables\Columns\TextColumn::make('kategori')
                ->label('Kategori')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'VIP (Free Merchandise)' => 'purple',
                    'CAT 1' => 'info',
                    default => 'gray',
                }),
        Tables\Columns\TextColumn::make('jumlah_tiket')
                ->label('Jumlah')
                ->alignCenter(),
        Tables\Columns\ImageColumn::make('qr_code')
                ->label('QR Cadangan')
                ->defaultImageUrl(fn ($record) => 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $record->qr_code)
                ->circular(),
        Tables\Columns\IconColumn::make('is_checked_in')
                ->label('Sudah Hadir?')
                ->boolean(),
        ])

        ->filters([ 
            //
        ])
        ->actions([
            EditAction::make(),
        ])
        ->bulkActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
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
            'index' => ListTickets::route('/'),
            'create' => CreateTicket::route('/create'),
            'edit' => EditTicket::route('/{record}/edit'),
        ];
    }

}
