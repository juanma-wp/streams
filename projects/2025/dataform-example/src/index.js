/**
 * WordPress dependencies
 */
import domReady from "@wordpress/dom-ready";
import { createRoot } from "@wordpress/element";
import { DataForm, useFormValidity } from '@wordpress/dataviews/wp';

import { useState } from '@wordpress/element';

const fields = [
  {
    id: "name",
    label: "Customer Name",
    type: "text",
    isValid: {
      required: true,
    },
  },
  {
    id: "phone",
    label: "Phone",
    type: "text",
    isValid: {
      required: true,
    },
  },
  {
    id: "email",
    label: "Email",
    type: "email",
    isValid: {
      required: true,
    },
  },
  {
    id: "plan",
    label: "Plan",
    type: "text",
    Edit: "toggleGroup",
    elements: [
      { value: "basic", label: "Basic" },
      { value: "business", label: "Business" },
      { value: "vip", label: "VIP" },
    ],
  },
  {
    id: "shippingAddress",
    label: "Shipping Address",
    type: "text",
  },
  {
    id: "billingAddress",
    label: "Billing Address",
    type: "text",
  },
  {
    id: "displayPayments",
    label: "Display Payments?",
    type: "boolean",
  },
  {
    id: "payments",
    label: "Payments",
    type: "text",
    readOnly: true, // Triggers using the render method instead of Edit.
    isVisible: (item) => item.displayPayments,
    render: ({ item }) => {
      return (
        <p>
          The customer has made a total of {item.totalOrders} orders, amounting
          to {item.totalRevenue} dollars. The average order value is{" "}
          {item.averageOrderValue} dollars.
        </p>
      );
    },
  },
  {
    id: "vat",
    label: "VAT",
    type: "integer",
  },
  {
    id: "commission",
    label: "Commission",
    type: "integer",
  },
  {
    id: "dueDate",
    label: "Due Date",
    type: "text",
    render: ({ item }) => {
      return <p>Due on: {item.dueDate}</p>;
    },
  },
  {
    id: "plan-summary",
    type: "text",
    readOnly: true,
    render: ({ item }) => {
      return <p>🔥 {item.plan}</p>;
    },
  },
];

const form = {
  fields: [
    {
      children: [
        {
          children: [
            {
              id: "name",
              layout: {
                labelPosition: "top",
                type: "regular",
              }
            },
            {
              id: "phone",
              layout: {
                labelPosition: "top",
                type: "regular",
              },
            },
            {
              id: "email",
              layout: {
                labelPosition: "top",
                type: "regular",
              },
            },
          ],
          id: "customerContact",
          label: "Contact",
          layout: {
            labelPosition: "top",
            type: "panel",
          },
        },
        {
          id: "plan",
          layout: {
            labelPosition: "top",
            type: "panel",
          },
        },
        {
          id: "shippingAddress",
          layout: {
            labelPosition: "top",
            type: "panel",
          },
        },
        {
          id: "billingAddress",
          layout: {
            labelPosition: "top",
            type: "panel",
          },
        },
        "displayPayments",
      ],
      description:
        "Enter your contact details, plan type, and addresses to complete your customer information.",
      id: "customerCard",
      label: "Customer",
      layout: {
        isCollapsible: true,
        summary: "plan-summary",
        type: "card",
      },
    },
    {
      id: "payments",
      layout: {
        type: "card",
        withHeader: false,
      },
    },
    {
      children: ["vat", "commission"],
      id: "taxConfiguration",
      label: "Taxes",
      layout: {
        isCollapsible: true,
        isOpened: false,
        summary: [
          {
            id: "dueDate",
            visibility: "always",
          },
        ],
        type: "card",
      },
    },
  ],
  layout: {
    type: "card",
    withHeader: true,
  },
};

const SimpleDataForm = () => {

	const [data, setData] = useState({
		averageOrderValue: 715,
		billingAddress: "Danyka Romaguera, West Myrtiehaven, 80240-4282, BI",
		commission: 5,
		displayPayments: true,
		dueDate: "March 1st, 2028",
		email: "aromaguera@example.org",
		hasVat: true,
		name: "Danyka Romaguera",
		phone: "1-828-352-1250",
		plan: "basic",
		shippingAddress: "N/A",
		totalOrders: 2,
		totalRevenue: 1430,
		vat: 10,
	});

	const { validity, isValid } = useFormValidity(data, fields, form);

	console.log(data);
	console.log(fields);
	console.log(form);
	console.log( validity, isValid );

	return (
    <div>
		<p>Form is { isValid ? 'valid' : 'invalid' }</p>
      <DataForm
        data={data}  
        fields={fields}
        form={form}
        validation={validity}
        onChange={updatedData => setData({
			...data,
			...updatedData
		})}
      />
    </div>
  );
};

domReady( () => {
	const root = document.getElementById( 'dataform-example-root' );
	if ( root ) {
		createRoot( root ).render( <SimpleDataForm /> );
	}
} );
