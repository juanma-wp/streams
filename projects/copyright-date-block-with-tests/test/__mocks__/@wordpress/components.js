const PanelBody = ({ title, children }) => (
  <div data-testid="panel-body" data-title={title}>
    {children}
  </div>
);
const TextControl = () => <div data-testid="text-control"></div>;
const ToggleControl = () => <div data-testid="toggle-control"></div>;

module.exports = {
  PanelBody,
  TextControl,
  ToggleControl,
};
