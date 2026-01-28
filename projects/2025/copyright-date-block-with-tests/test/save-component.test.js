import { render } from "@testing-library/react";
import Save from "../src/save";

describe.only("Save Function", () => {
  it("returns null if fallbackCurrentYear is not set", () => {
    const testProps = {
      attributes: {
        fallbackCurrentYear: null,
      },
    };
    const result = Save(testProps);
    expect(result).toBeNull();
  });
  it("displays only the current year when showStartingYear is false", () => {
    const testProps = {
      attributes: {
        fallbackCurrentYear: "2024",
        showStartingYear: false,
      },
    };
    const { container } = render(<Save {...testProps} />);
    expect(container.textContent).toContain("© 2024");
  });
});
