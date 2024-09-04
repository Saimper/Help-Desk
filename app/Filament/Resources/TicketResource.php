<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->label('Title'),
                
                Textarea::make('description')
                    ->required()
                    ->label('Description'),

                Select::make('status')
                    ->options([
                        'open' => 'Open',
                        'in_progress' => 'In Progress',
                        'closed' => 'Closed',
                    ])
                    ->default('open')
                    ->label('Status'),

                Select::make('priority')
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                    ])
                    ->default('medium')
                    ->label('Priority'),

                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->label('Category'),

                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('Creator'),

                Forms\Components\Select::make('assigned_to')
                    ->relationship('assignedUser', 'name')
                    ->nullable()
                    ->label('Assigned To'),

                DatePicker::make('closed_at')
                    ->nullable()
                    ->label('Closed At'),

                Textarea::make('resolution')
                    ->nullable()
                    ->label('Resolution'),

                Forms\Components\TextInput::make('attachments')
                    ->nullable()
                    ->label('Attachments'),

                Forms\Components\TextInput::make('tags')
                    ->nullable()
                    ->label('Tags'),

                DatePicker::make('due_date')
                    ->nullable()
                    ->label('Due Date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title'),

                TextColumn::make('description')
                    ->label('Description'),

                TextColumn::make('status')
                    ->label('Status'),

                TextColumn::make('priority')
                    ->label('Priority'),

                TextColumn::make('category.name')
                    ->label('Category'),

                TextColumn::make('user.name')
                    ->label('Creator'),

                TextColumn::make('assignedUser.name')
                    ->label('Assigned To'),

                TextColumn::make('closed_at')
                    ->label('Closed At')
                    ->date('d/m/Y H:i'),

                TextColumn::make('resolution')
                    ->label('Resolution'),

                TextColumn::make('attachments')
                    ->label('Attachments'),

                TextColumn::make('tags')
                    ->label('Tags'),

                TextColumn::make('due_date')
                    ->label('Due Date')
                    ->date('d/m/Y'),
            ])
            ->filters([
                // Define your filters here
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
            // Define your relations here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
