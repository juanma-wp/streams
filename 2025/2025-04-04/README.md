# 2025-04-04 JavaScript y React para Wordpress: Lo Básico

[![](./thumbnail.png)](https://www.youtube.com/watch?v=vAyO9mQNzlU&t=6786s)

- https://excalidraw.com/#json=k3Y9eF5zbqE0dFxhQhbuT,8chEZUaLpB9s86HM30yWPQ
- https://developer.mozilla.org/en-US/docs/Glossary/Engine/JavaScript
- https://nodejs.org/en
- https://en.wikipedia.org/wiki/ECMAScript_version_history
- https://developer.wordpress.org/block-editor/getting-started/devenv/get-started-with-create-block/
- https://developer.wordpress.org/block-editor/getting-started/devenv/get-started-with-wp-scripts/
- https://webpack.js.org/
- https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Modules
- https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Grammar_and_types
- https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Destructuring
- https://react.dev/learn/writing-markup-with-jsx
- https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Spread_syntax
- https://developer.wordpress.org/block-editor/getting-started/fundamentals/block-wrapper/

Código final del `Edit.js` trabajado en la sesión

```js
import { __ } from "@wordpress/i18n";
import { useBlockProps } from "@wordpress/block-editor";
import "./editor.scss";
import { useState, useEffect } from "@wordpress/element";

const Message = (props) => {
  const { number, message, name } = props;
  return <p>{`${number} - Hi ${name}, ${message}`}</p>;
};

const messageProps = {
  message: "Good morning!",
  name: "Juanma",
};
const { message, name } = messageProps;

const Edit = (props) => {
  const [number, setNumber] = useState(0);
  useEffect(() => {
    const interval = setInterval(() => {
      setNumber((prevNumber) => prevNumber + 1);
    }, 1000);

    return () => clearInterval(interval);
  }, []);
  return (
    <div {...useBlockProps()}>
      <Message number={number} {...messageProps} />
      <p>
        {__(
          "Mi Primer Bloque Js – hello from the editor!",
          "mi-primer-bloque-js"
        )}
      </p>
    </div>
  );
};

export default Edit;
```
