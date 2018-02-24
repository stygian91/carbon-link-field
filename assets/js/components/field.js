/**
 * The external dependencies.
 */
import React from 'react';
import PropTypes from 'prop-types';
import { compose, withHandlers, setStatic } from 'recompose';

/**
 * The internal dependencies.
 */
import Field from 'fields/components/field';
import withStore from 'fields/decorators/with-store';
import withSetup from 'fields/decorators/with-setup';

/**
 * Render a number input field.
 *
 * @param  {Object}        props
 * @param  {String}        props.name
 * @param  {Object}        props.field
 * @param  {Function}      props.handleLinkChange
 * @param  {Function}      props.handleLabelChange
 * @param  {Function}      props.handleTargetChange
 * @return {React.Element}
 */
export const LinkField = ({
	name,
	field,
	handleLinkChange,
	handleLabelChange,
	handleTargetChange
}) => {
	return (
		<Field field={field}>
			<label className="label">
				Label
				<input
					type="text"
					name={`${name}[label]`}
					value={field.value.label}
					className="regular-text"
					onChange={handleLabelChange}
				/>
			</label>
	
			<label className="link">
				Link
				<input
					type="text"
					name={`${name}[link]`}
					value={field.value.link}
					className="regular-text"
					onChange={handleLinkChange}
				/>
			</label>

			<label className="target">
				Open in a new tab
				<input
					type="checkbox"
					name={`${name}[target]`}
					checked={field.value.target}
					onChange={handleTargetChange}
					value="checked"
				/>
			</label>
		</Field>
	);
}

/**
 * Validate the props.
 *
 * @type {Object}
 */
LinkField.propTypes = {
	name: PropTypes.string,
	field: PropTypes.shape({
		value: PropTypes.shape({
			link: PropTypes.string,
			label: PropTypes.string,
			target: PropTypes.bool,
		}),
	}),
	handleLinkChange: PropTypes.func,
	handleLabelChange: PropTypes.func,
	handleTargetChange: PropTypes.func,
};

/**
 * The enhancer.
 *
 * @type {Function}
 */
export const enhance = compose(
	/**
	 * Connect to the Redux store.
	 */
	withStore(),

	/**
	 * Attach the setup hooks.
	 */
	withSetup(),

	/**
	 * The handlers passed to the component.
	 */
	withHandlers({
		handleLinkChange: ({ field, setFieldValue }) => ({ target: { value } }) => {
			const fieldValue = {...field.value};
			fieldValue.link = value;
			setFieldValue(field.id, fieldValue);
		},

		handleLabelChange: ({field, setFieldValue}) => ({ target: { value } }) => {
			const fieldValue = {...field.value};
			fieldValue.label = value;
			setFieldValue(field.id, fieldValue);
		},

		handleTargetChange: ({field, setFieldValue}) => ({ target: { checked } }) => {
			const fieldValue = {...field.value};
			fieldValue.target = checked;
			setFieldValue(field.id, fieldValue);
		},
	})
);

export default setStatic('type', [
	'link',
])(enhance(LinkField));

