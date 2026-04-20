<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationLabel = 'Contact Messages';
    protected static ?string $modelLabel = 'Contact Message';
    protected static ?string $pluralModelLabel = 'Contact Messages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(120),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(180),

                Forms\Components\Select::make('project_type')
                    ->label('Project Type')
                    ->options([
                        'Web Design' => 'Web Design',
                        'Photography' => 'Photography',
                        'Video Production' => 'Video Production',
                        'Illustration' => 'Illustration',
                    ])
                    ->searchable()
                    ->native(false)
                    ->nullable(),

                Forms\Components\Textarea::make('message')
                    ->required()
                    ->rows(6)
                    ->maxLength(5000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('project_type')
                    ->label('Type')
                    ->badge()
                    ->toggleable(),

                TextColumn::make('message')
                    ->label('Message')
                    ->limit(60)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('project_type')
                    ->label('Project Type')
                    ->options([
                        'Web Design' => 'Web Design',
                        'Photography' => 'Photography',
                        'Video Production' => 'Video Production',
                        'Illustration' => 'Illustration',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
{
    return [
        'index' => Pages\ListContactMessages::route('/'),
        'create' => Pages\CreateContactMessage::route('/create'),
        'edit' => Pages\EditContactMessage::route('/{record}/edit'),
    ];
}
}