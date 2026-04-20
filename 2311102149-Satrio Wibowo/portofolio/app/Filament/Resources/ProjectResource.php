<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'Projects';
    protected static ?string $pluralModelLabel = 'Projects';
    protected static ?string $modelLabel = 'Project';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Project')
                ->columns(12)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        ->maxLength(255)
                        ->columnSpan(8)
                        ->afterStateUpdated(function ($state, Forms\Set $set) {
                            $set('slug', Str::slug($state));
                        }),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true)
                        ->columnSpan(4),

                    Forms\Components\Select::make('category')
                        ->required()
                        ->options([
                            'design' => 'Design',
                            'photo' => 'Photo',
                            'video' => 'Video',
                            'illustration' => 'Illustration',
                        ])
                        ->native(false)
                        ->columnSpan(4),

                    Forms\Components\TextInput::make('year')
                        ->numeric()
                        ->minValue(1900)
                        ->maxValue((int) date('Y') + 1)
                        ->columnSpan(2),

                    Forms\Components\Toggle::make('is_featured')
                        ->label('Featured (Landing)')
                        ->inline(false)
                        ->columnSpan(3),

                    Forms\Components\DateTimePicker::make('published_at')
                        ->label('Published at (optional)')
                        ->seconds(false)
                        ->columnSpan(3),

                    Forms\Components\Textarea::make('description')
                        ->rows(4)
                        ->columnSpan(12),

                    Forms\Components\TagsInput::make('tags')
                        ->placeholder('Add tags…')
                        ->columnSpan(12),
                ]),

            Forms\Components\Section::make('Media')
                ->description('Upload images/video. Set one item as Thumbnail for the Work card.')
                ->schema([
                    Forms\Components\Repeater::make('media')
                        ->relationship()
                        ->orderColumn('sort_order') // drag reorder -> sort_order
                        ->reorderable()
                        ->collapsed()
                        ->itemLabel(function (array $state): ?string {
                            $type = $state['type'] ?? 'media';
                            $role = $state['role'] ?? 'gallery';
                            $cap  = $state['caption'] ?? null;
                            return trim(ucfirst($role) . ' • ' . strtoupper($type) . ($cap ? " — {$cap}" : ''));
                        })
                        ->schema([
                            Forms\Components\Grid::make(12)->schema([
                                Forms\Components\Select::make('type')
                                    ->required()
                                    ->options([
                                        'image' => 'Image',
                                        'video' => 'Video',
                                    ])
                                    ->native(false)
                                    ->reactive()
                                    ->columnSpan(3),

                                Forms\Components\Select::make('role')
                                    ->required()
                                    ->options([
                                        'thumbnail' => 'Thumbnail',
                                        'gallery' => 'Gallery',
                                        'cover' => 'Cover',
                                    ])
                                    ->native(false)
                                    ->columnSpan(3),

                                Forms\Components\TextInput::make('caption')
                                    ->maxLength(255)
                                    ->columnSpan(6),
                            ]),

                            // === IMAGE UPLOAD (untuk type=image)
                            Forms\Components\FileUpload::make('path')
                                ->label('Image file')
                                ->directory('portfolio/images')
                                ->disk('public')
                                ->image()
                                ->imageEditor() // optional editor bawaan Filament
                                ->maxSize(10240) // 10MB
                                ->visibility('public')
                                ->openable()
                                ->downloadable()
                                ->hidden(fn (Forms\Get $get) => $get('type') !== 'image'),

                            // === VIDEO: provider (youtube/vimeo/custom)
                            Forms\Components\Select::make('provider')
                                ->label('Video provider')
                                ->options([
                                    'youtube' => 'YouTube',
                                    'vimeo' => 'Vimeo',
                                    'custom' => 'Custom MP4',
                                ])
                                ->native(false)
                                ->reactive()
                                ->hidden(fn (Forms\Get $get) => $get('type') !== 'video'),

                            Forms\Components\TextInput::make('embed_id')
                                ->label('Embed ID')
                                ->helperText('YouTube/Vimeo ID (contoh YouTube: dQw4w9WgXcQ)')
                                ->maxLength(255)
                                ->hidden(fn (Forms\Get $get) => $get('type') !== 'video' || !in_array($get('provider'), ['youtube','vimeo'], true)),

                            Forms\Components\FileUpload::make('path')
                                ->label('MP4 file')
                                ->directory('portfolio/videos')
                                ->disk('public')
                                ->acceptedFileTypes(['video/mp4'])
                                ->maxSize(51200) // 50MB (sesuaikan)
                                ->visibility('public')
                                ->openable()
                                ->downloadable()
                                ->hidden(fn (Forms\Get $get) => $get('type') !== 'video' || $get('provider') !== 'custom'),

                            Forms\Components\FileUpload::make('poster_path')
                                ->label('Poster image (optional)')
                                ->directory('portfolio/posters')
                                ->disk('public')
                                ->image()
                                ->maxSize(10240)
                                ->visibility('public')
                                ->openable()
                                ->hidden(fn (Forms\Get $get) => $get('type') !== 'video'),

                            // === EXIF (opsional untuk photo)
                            Forms\Components\Textarea::make('exif')
                                ->label('EXIF (JSON, optional)')
                                ->rows(4)
                                ->helperText('Contoh: {"camera":"Sony A7IV","lens":"35mm","iso":800,"aperture":"f/1.8","shutter":"1/200","focal":"35mm"}')
                                ->hidden(fn (Forms\Get $get) => $get('type') !== 'image'),
                        ])
                        ->defaultItems(0)
                        ->addActionLabel('Add media')
                        ->columns(1),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('category')
                    ->colors([
                        'gray' => 'design',
                        'info' => 'photo',
                        'warning' => 'video',
                        'success' => 'illustration',
                    ])
                    ->formatStateUsing(fn ($state) => strtoupper($state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('year')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'design' => 'Design',
                        'photo' => 'Photo',
                        'video' => 'Video',
                        'illustration' => 'Illustration',
                    ]),
                Tables\Filters\TernaryFilter::make('is_featured')->label('Featured'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}