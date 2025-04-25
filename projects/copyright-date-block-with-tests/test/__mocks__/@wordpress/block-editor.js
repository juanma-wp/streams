const useBlockProps = jest.fn(() => ({
  className: "wp-block-copyright-date",
}));

const InspectorControls = () => <div data-testid="inspector-controls"></div>;

module.exports = {
  useBlockProps,
  InspectorControls,
};
