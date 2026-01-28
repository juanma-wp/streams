const useBlockProps = jest.fn(() => ({
  className: "wp-block-copyright-date",
}));

useBlockProps.save = jest.fn();

const InspectorControls = ({ children }) => (
  <div data-testid="inspector-controls">{children}</div>
);

module.exports = {
  useBlockProps,
  InspectorControls,
};
