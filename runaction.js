window.runAction = async function (action_name, data) {
    return await axios.post(
        window.route("run-action"),
        Object.assign({ action_name }, data)
    );
};