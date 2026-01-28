import { DataViews } from '@wordpress/dataviews';
import { data as dataPlanets } from './data';
import { __experimentalHStack as HStack, Icon } from '@wordpress/components';
import { SVG, Path } from '@wordpress/primitives';

console.log( 'dataPlanets', dataPlanets );
// const primaryField = 'id';
// const mediaField = 'image';

// const defaultLayouts = {
// 	table: {
// 		layout: {
// 			primaryField,
// 		},
// 	},
// 	grid: {
// 		layout: {
// 			primaryField,
// 			mediaField,
// 		},
// 	},
// };

const fields = [
	{
		id: 'image',
		label: 'Image',
		enableHiding: false,
		enableSorting: false,
		filterBy: false,
		header: (
			<HStack justify="start" spacing={ 1 }>
				<Icon
					icon={
						<SVG
							viewBox="0 0 24 24"
							xmlns="http://www.w3.org/2000/svg"
						>
							<Path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM5 4.5h14c.3 0 .5.2.5.5v8.4l-3-2.9c-.3-.3-.8-.3-1 0L11.9 14 9 12c-.3-.2-.6-.2-.8 0l-3.6 2.6V5c-.1-.3.1-.5.4-.5zm14 15H5c-.3 0-.5-.2-.5-.5v-2.4l4.1-3 3 1.9c.3.2.7.2.9-.1L16 12l3.5 3.4V19c0 .3-.2.5-.5.5z" />
						</SVG>
					}
				/>
				<span>Image</span>
			</HStack>
		),
		render: ( { item } ) => (
			<img src={ item.image } alt={ item.name.title } />
		),
		type: 'media',
	},
	{
		id: 'name.title',
		label: 'Title',
		enableGlobalSearch: true,
		enableHiding: false,
		enableSorting: false,
		filterBy: false,
		isValid: {
			required: true,
		},
		type: 'text',
	},
	{
		id: 'date',
		label: 'Date',
		enableHiding: false,
		enableSorting: false,
		filterBy: false,
		type: 'date',
	},
	{
		id: 'datetime',
		label: 'Datetime',
		enableHiding: false,
		enableSorting: false,
		filterBy: false,
		type: 'datetime',
	},
	{
		id: 'type',
		label: 'Type',
		elements: [
			{
				label: 'Satellite',
				value: 'Satellite',
			},
			{
				label: 'Ice giant',
				value: 'Ice giant',
			},
			{
				label: 'Terrestrial',
				value: 'Terrestrial',
			},
			{
				label: 'Gas giant',
				value: 'Gas giant',
			},
			{
				label: 'Dwarf planet',
				value: 'Dwarf planet',
			},
			{
				label: 'Asteroid',
				value: 'Asteroid',
			},
			{
				label: 'Comet',
				value: 'Comet',
			},
			{
				label: 'Kuiper belt object',
				value: 'Kuiper belt object',
			},
			{
				label: 'Protoplanet',
				value: 'Protoplanet',
			},
			{
				label: 'Planetesimal',
				value: 'Planetesimal',
			},
			{
				label: 'Minor planet',
				value: 'Minor planet',
			},
			{
				label: 'Trans-Neptunian object',
				value: 'Trans-Neptunian object',
			},
		],
		enableHiding: false,
		enableSorting: false,
		filterBy: false,
	},
	{
		id: 'isPlanet',
		label: 'Is Planet',
		elements: [
			{
				label: 'True',
				value: true,
			},
			{
				label: 'False',
				value: false,
			},
		],
		enableHiding: false,
		enableSorting: false,
		filterBy: false,
		setValue: () => {},
		type: 'boolean',
	},
	{
		id: 'satellites',
		label: 'Satellites',
		enableHiding: false,
		enableSorting: false,
		filterBy: false,
		type: 'integer',
	},
	{
		id: 'name.description',
		label: 'Description',
		enableGlobalSearch: true,
		enableHiding: false,
		enableSorting: false,
		filterBy: false,
		type: 'text',
	},
	{
		enableHiding: false,
		enableSorting: false,
		filterBy: false,
		id: 'email',
		label: 'Email',
		type: 'email',
	},
	{
		elements: [
			{
				label: 'Solar system',
				value: 'Solar system',
			},
			{
				label: 'Satellite',
				value: 'Satellite',
			},
			{
				label: 'Moon',
				value: 'Moon',
			},
			{
				label: 'Earth',
				value: 'Earth',
			},
			{
				label: 'Jupiter',
				value: 'Jupiter',
			},
			{
				label: 'Planet',
				value: 'Planet',
			},
			{
				label: 'Ice giant',
				value: 'Ice giant',
			},
			{
				label: 'Terrestrial',
				value: 'Terrestrial',
			},
			{
				label: 'Gas giant',
				value: 'Gas giant',
			},
		],
		enableGlobalSearch: true,
		enableHiding: false,
		enableSorting: false,
		filterBy: false,
		header: (
			<HStack justify="start" spacing={ 1 }>
				<Icon
					icon={
						<SVG
							viewBox="0 0 24 24"
							xmlns="http://www.w3.org/2000/svg"
						>
							<Path
								clipRule="evenodd"
								d="M6 5.5h3a.5.5 0 01.5.5v3a.5.5 0 01-.5.5H6a.5.5 0 01-.5-.5V6a.5.5 0 01.5-.5zM4 6a2 2 0 012-2h3a2 2 0 012 2v3a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm11-.5h3a.5.5 0 01.5.5v3a.5.5 0 01-.5.5h-3a.5.5 0 01-.5-.5V6a.5.5 0 01.5-.5zM13 6a2 2 0 012-2h3a2 2 0 012 2v3a2 2 0 01-2 2h-3a2 2 0 01-2-2V6zm5 8.5h-3a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5zM15 13a2 2 0 00-2 2v3a2 2 0 002 2h3a2 2 0 002-2v-3a2 2 0 00-2-2h-3zm-9 1.5h3a.5.5 0 01.5.5v3a.5.5 0 01-.5.5H6a.5.5 0 01-.5-.5v-3a.5.5 0 01.5-.5zM4 15a2 2 0 012-2h3a2 2 0 012 2v3a2 2 0 01-2 2H6a2 2 0 01-2-2v-3z"
								fillRule="evenodd"
							/>
						</SVG>
					}
				/>
				<span>Categories</span>
			</HStack>
		),
		id: 'categories',
		label: 'Categories',
		type: 'array',
	},
];

const DemoDataViews2 = () => {
	return (
		<DataViews
			data={ dataPlanets }
			defaultLayouts={ {
				table: {},
			} }
			fields={ fields }
			onChangeView={ () => {} }
			paginationInfo={ {
				totalItems: 10,
				totalPages: 1,
			} }
			view={ {
				mediaField: 'image',
				titleField: 'name.title',
				descriptionField: 'name.description',
				fields: [ 'categories' ],
				filters: [],
				layout: {
					enableMoving: false,
				},
				page: 1,
				perPage: 10,
				search: '',
				type: 'table',
			} }
		/>
	);
};

export default DemoDataViews2;
