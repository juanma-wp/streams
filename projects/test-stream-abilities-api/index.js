const { getAbilities, executeAbility } = wp.abilities;

console.log("Hello from the editor");
console.log(wp.abilities);

const doSomethingWithAbilities = async () => {
    const abilities = await getAbilities();
    console.log(`Found ${abilities.length} abilities`);

    // List all abilities
    abilities.forEach((ability) => {
      console.log(`${ability.name}: ${ability.description}`);
    });

    // Get abilities in a specific category
    const dataAbilities = await getAbilities({ category: "data-retrieval" });

    console.log(`Found ${dataAbilities.length} data retrieval abilities`);

    // ------

    const {name, description, url} = await executeAbility("my-plugin/get-site-info");
    console.log("Site:", name);
    console.log("Description:", description);
    console.log("URL:", url);

}

doSomethingWithAbilities();
