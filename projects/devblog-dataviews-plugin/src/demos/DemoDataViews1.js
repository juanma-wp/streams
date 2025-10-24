import { DataViews, filterSortAndPaginate } from '@wordpress/dataviews';
import { data as dataPlanets } from './data';
import { __experimentalHStack as HStack, Icon } from '@wordpress/components';
import { SVG, Path } from '@wordpress/primitives';
import { useState, useMemo } from '@wordpress/element';

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

const elementDemoDataViews1 = [
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
];
const actionsDemoDataViews1 = [
	{
		RenderModal: () => {},

		icon: (
			<SVG viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<Path
					clipRule="evenodd"
					d="M12 5.5A2.25 2.25 0 0 0 9.878 7h4.244A2.251 2.251 0 0 0 12 5.5ZM12 4a3.751 3.751 0 0 0-3.675 3H5v1.5h1.27l.818 8.997a2.75 2.75 0 0 0 2.739 2.501h4.347a2.75 2.75 0 0 0 2.738-2.5L17.73 8.5H19V7h-3.325A3.751 3.751 0 0 0 12 4Zm4.224 4.5H7.776l.806 8.861a1.25 1.25 0 0 0 1.245 1.137h4.347a1.25 1.25 0 0 0 1.245-1.137l.805-8.861Z"
					fillRule="evenodd"
				/>
			</SVG>
		),

		id: 'delete',
		isPrimary: true,
		label: 'Delete item',
		modalFocusOnMount: 'firstContentElement',
		modalHeader: () => {},
		supportsBulk: true,
	},
	{
		callback: () => {},
		id: 'secondary',
		label: 'Secondary action',
	},
];

const fields = [
	{
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

		id: 'image',
		label: 'Image',
		render: ( { item } ) => <img src={ item.image } alt={ item.title } />,
		type: 'media',
	},
	{
		enableGlobalSearch: true,
		enableHiding: true,
		filterBy: {
			operators: [ 'contains', 'notContains', 'startsWith' ],
		},
		id: 'name.title',
		isValid: {
			required: true,
		},
		label: 'Title',
		type: 'text',
	},
	{
		id: 'date',
		label: 'Date',
		type: 'date',
	},
	{
		id: 'datetime',
		label: 'Datetime',
		type: 'datetime',
	},
	{
		elements: elementDemoDataViews1,
		enableHiding: false,
		filterBy: {
			operators: [ 'is', 'isNot' ],
		},
		id: 'type',
		label: 'Type',
	},
	/*
				{
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
					id: 'isPlanet',
					label: 'Is Planet',
					setValue: () => {},
					type: 'boolean',
				},
				{
					enableSorting: true,
					id: 'satellites',
					label: 'Satellites',
					type: 'integer',
				},
                */
	{
		enableGlobalSearch: true,
		enableSorting: false,
		filterBy: {
			operators: [ 'contains', 'notContains', 'startsWith' ],
		},
		id: 'name.description',
		label: 'Description',
		type: 'text',
	},
	/*
				{
					id: 'email',
					label: 'Email',
					type: 'email',
				},
                */
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

const DemoDataViews1 = () => {
	// "view" and "setView" definition
	const [ view, setView ] = useState( {
		fields: [ 'categories' ],
		filters: [],
		layout: {
			styles: {
				satellites: {
					align: 'end',
				},
			},
		},
		descriptionField: 'name.description',
		titleField: 'name.title',
		mediaField: 'image',
		page: 1,
		perPage: 5,
		search: '',
		type: 'table',
	} );

	// "processedData" and "paginationInfo" definition
	const { data: processedData, paginationInfo } = useMemo( () => {
		return filterSortAndPaginate( dataPlanets, view, fields );
	}, [ view ] );

	console.log( 'view', view );
	return (
		<DataViews
			actions={ actionsDemoDataViews1 }
			config={ {
				perPageSizes: [ 10, 25, 50, 100 ],
			} }
			defaultLayouts={ {
				grid: {},
				list: {},
				table: {},
			} }
			fields={ fields }
			/*
			getItemId={ () => {} }
			isItemClickable={ () => {} }
            */
			paginationInfo={ paginationInfo }
			data={ processedData }
			/* renderItemLink={ () => {} } */
			view={ view }
			onChangeView={ setView }
			empty={ <p>{ view.search ? 'No planets found' : 'No planets' }</p> }
		/>
	);
};

export default DemoDataViews1;
